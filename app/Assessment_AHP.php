<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment_AHP extends Model
{
    //
    protected $guarded = [];

    public static function getMaxMin($criterias)
    {
       
        $arr = [];
        foreach ($criterias as $key => $criteria) {
            $decoded = json_decode($criteria->ahp, true);
            $arr[$criteria['criteria_code']] = [
                'name' => $criteria['name'],
                'type' => $criteria['type'],
                'max_weight' => max(array_column($decoded, 'weight')),
                'min_weight' => min(array_column($decoded, 'weight'))
            ];
        }
        return $arr;
    }

    // Menentukan Score
    public static function dss_ahp()
    {
        $criterias = Criteria::orderBy('criteria_code', 'ASC')->has('ahp')->with('sub_criteria')->get();
        $media = Media::orderBy('id', 'ASC')->has('ahp')->with('ahp')->get();
        $arr = [];
        $score = [];
        $minmax = self::getMaxMin($criterias);

        // Langkah 2: Membuat matriks perbandingan pasangan
        $pairwiseMatrix = [];
        foreach ($criterias as $i => $criteria) {
            foreach ($criterias as $j => $otherCriteria) {
                $pairwiseMatrix[$i][$j] = 1; // Set nilai awal matriks perbandingan pasangan
                if ($i !== $j) {
                    // Hitung perbandingan pasangan berdasarkan penilaian
                    $totalWeight = 1;
                    foreach ($media as $m) {
                        foreach ($m->ahp as $ahp) {
                            if ($ahp->criteria_id == $criteria->id && $ahp->criteria_id == $otherCriteria->id) {
                                $totalWeight += $ahp->weight;
                            }
                        }
                    }
                    $pairwiseMatrix[$i][$j] = $totalWeight;
                    $pairwiseMatrix[$j][$i] = 2 / $totalWeight;
        
                }
            }
        }

        // Langkah 3: Normalisasi matriks perbandingan pasangan
        $normalizedMatrix = [];
        $columnSum = array_fill(0, count($criterias), 0);
        foreach ($pairwiseMatrix as $i => $row) {
            $rowSum = array_sum($row);
            $normalizedMatrix[$i] = [];
            foreach ($row as $j => $value) {
                $denominator = $minmax[$criterias[$i]['criteria_code']]['max_weight'] - $minmax[$criterias[$i]['criteria_code']]['min_weight'];
                if ($denominator != 0) {
                    $normalizedValue = ($value - $minmax[$criterias[$i]['criteria_code']]['min_weight']) / $denominator;
                } else {
                    $normalizedValue = 1; // Nilai default jika pembagian oleh nol terjadi
                }
                $normalizedMatrix[$i][$j] = $normalizedValue;
                $columnSum[$j] += $normalizedValue;
            }
        }


        // Langkah 4: Hitung bobot relatif
        $weights = [];
        $columnMax = array_fill(0, count($criterias), 0);
        $columnMin = array_fill(0, count($criterias), PHP_INT_MAX);
        $matrixSize = count($criterias);

        for ($i = 0; $i < $matrixSize; $i++) {
            for ($j = 0; $j < $matrixSize; $j++) {
                if ($pairwiseMatrix[$j][$i] > $columnMax[$i]) {
                    $columnMax[$i] = $pairwiseMatrix[$j][$i];
                }
                if ($pairwiseMatrix[$j][$i] < $columnMin[$i]) {
                    $columnMin[$i] = $pairwiseMatrix[$j][$i];
                }
            }
        }

        for ($i = 0; $i < $matrixSize; $i++) {
            // Hitung bobot relatif dengan menggunakan nilai maksimum dan minimum kolom
            $weights[$i] = ($columnMax[$i] - $columnMin[$i]) / ($matrixSize - 1);
        }



        // Langkah 5: Evaluasi alternatif
        foreach ($media as $index => $m) {
            $arr[$index] = [
                'media_name' => $m->media_name
            ];

            $totalScore = 0;
            foreach ($criterias as $i => $criteria) {
                $criteriaScore = $ahp->weight;
                foreach ($m->ahp as $ahp) {
                    if ($ahp->criteria_id == $criteria->id) {
                        // Hitung nilai skor alternatif berdasarkan bobot relatif
                        $criteriaScore += $ahp->weight * $weights[$i];
                    }
                }
                $arr[$index]['criteria'][$criteria->criteria_code] = [
                    'name' => $criteria->name,
                    'type' => $criteria->type,
                    'weight' => $weights[$i],
                    'score' => $criteriaScore
                ];
                $totalScore += $criteriaScore;
            }
            $arr[$index]['score'] = $totalScore;
        }

        // Langkah 6: Urutkan alternatif berdasarkan skor
        usort($arr, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $arr;
    }
}
