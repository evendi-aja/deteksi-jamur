<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LatihModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class LatihController extends Controller
{
	public function __construct()
	{
		$this->LatihModel = new LatihModel;
		$this->allDataModel = collect($this->LatihModel->allData());
		$dataArray = $this->allDataModel->toArray();
		foreach ($this->allDataModel as $key => $value) {
			$this->datasetArray[$key] = (array) $value;
		}
		$this->Kondisi = [];


		$this->filterDataPoisonous = collect($this->filterData(collect($this->datasetArray), ['class' => 'Poisonous']));
		$this->filterDataEdible = collect($this->filterData(collect($this->datasetArray), ['class' => 'Edible']));


		if (!Session::has('dataUpdate')) {
			$latihPoisonous = (int) round(85 / 100 * count($this->filterDataPoisonous));
			$tesPoisonous = count($this->filterDataPoisonous) - $latihPoisonous;
			$latihEdible = (int) round(85 / 100 * count($this->filterDataEdible));
			$tesEdible = count($this->filterDataEdible) - $latihEdible;

			$dataLatih = array_merge($this->filterDataPoisonous->take($latihPoisonous)->toArray(), $this->filterDataEdible->take($latihEdible)->toArray());
			$dataTes = array_merge($this->filterDataPoisonous->take(-$tesPoisonous)->toArray(), $this->filterDataEdible->take(-$tesEdible)->toArray());

			// $dataPoisonousSplit = $this->filterDataPoisonous->split(3)->toArray();
			// $dataEdibleSplit = $this->filterDataEdible->split(3)->toArray();

			// $this->dataA = array_merge($dataPoisonousSplit[0], $dataEdibleSplit[0]);
			// $this->dataB = array_merge($dataPoisonousSplit[1], $dataEdibleSplit[1]);
			// $this->dataC = array_merge($dataPoisonousSplit[2], $dataEdibleSplit[2]);

			// $this->latihSatu = array_merge($this->dataA, $this->dataB);
			// $this->latihDua = array_merge($this->dataA, $this->dataC);
			// $this->latihTiga = array_merge($this->dataB, $this->dataC);

			// $dataTraining = $this->getDataLatih()->toArray();
			Session::put('dataUpdate', $dataLatih);
		}
	}

	public function dataBagi($latihBagi)
	{
		$this->perhitungan(true, $latihBagi);
		// $dataTraining = $this->getDataLatih()->toArray();
		$prediction = $this->prediction($latihBagi, $this->Kondisi);

		$benarEdible = 0;
		$benarPoisonous = 0;
		$salahEdible = 0;
		$salahPoisonous = 0;
		foreach ($latihBagi as $key => $value) {
			if ($latihBagi[$key]['class'] == $prediction[$key] && $prediction[$key] == "Edible") {
				$benarEdible++;
			} elseif ($latihBagi[$key]['class'] == $prediction[$key] && $prediction[$key] == "Poisonous") {
				$benarPoisonous++;
			} elseif ($latihBagi[$key]['class'] != $prediction[$key] && $prediction[$key] == "Edible") {
				$salahPoisonous++;
			} else {
				$salahEdible++;
			}
		}

		return ['benarEdible' => $benarEdible, 'title' => 'Hitung Data Latih', 'benarPoisonous' => $benarPoisonous, 'salahEdible' => $salahEdible, 'salahPoisonous' => $salahPoisonous];
	}

	// public function index()
	// {
	// 	$this->perhitungan();
	// 	var_dump($this->Kondisi);
	// 	return;
	// 	$data = [
	// 		'title' => 'Data Latih',
	// 		'latih' => $this->LatihModel->allData()
	// 	];
	// 	return view('latih.index', $data);
	// }

	public function tree()
	{
		$data = [
			'title' => 'Hitung Data Latih',
			'latih' => Session::get('dataUpdate'),

		];
		$dataSatu = $this->dataBagi($data['latih']);
		// var_dump($dataSatu);
		// return;
		// $dataDua = $this->dataBagi($this->latihDua);
		// $dataTiga = $this->dataBagi($this->latihTiga);
		// var_dump($dataSatu, $dataDua, $dataTiga);
		// return;



		return view('tree', ['title' => $data['title'], 'dataSatu' => $dataSatu]);
	}

	public function testing()
	{
		$data = [
			'title' => 'Hitung Data Testing',
			'testing' => $this->getDataTest()->toArray()

		];
		$this->perhitungan(true, $data['testing']);
		// $dataTraining = $this->getDataLatih()->toArray();
		$prediction = $this->prediction($data['testing'], $this->Kondisi);

		$benarEdible = 0;
		$benarPoisonous = 0;
		$salahEdible = 0;
		$salahPoisonous = 0;
		foreach ($data['testing'] as $key => $value) {
			if ($data['testing'][$key]['class'] == $prediction[$key] && $prediction[$key] == "Edible") {
				$benarEdible++;
			} elseif ($data['testing'][$key]['class'] == $prediction[$key] && $prediction[$key] == "Poisonous") {
				$benarPoisonous++;
			} elseif ($data['testing'][$key]['class'] != $prediction[$key] && $prediction[$key] == "Edible") {
				$salahPoisonous++;
			} else {
				$salahEdible++;
			}
		}

		// $dataSatu = $this->dataBagi($this->dataA);
		// $dataDua = $this->dataBagi($this->dataB);
		// $dataTiga = $this->dataBagi($this->dataC);
		// return view('testing', ['title' => $data['title'], 'dataSatu' => $dataSatu, 'dataDua' => $dataDua, 'dataTiga' => $dataTiga]);
		return view('testing', ['title' => $data['title'], 'benarEdible' => $benarEdible, 'benarPoisonous' => $benarPoisonous, 'salahPoisonous' => $salahPoisonous, 'salahEdible' => $salahEdible]);
	}

	public function perhitunganawal()
	{
		$this->perhitungan(false, Session::get('dataUpdate'));
		$data = $this->getAttribute();
		return view('latih.perhitunganawal', ['data' => $this->allData, 'title' => 'Perhitungan Awal', 'isi' => $data]);
	}

	public function hasilperhitunganpruning()
	{

		$data = [
			'title' => 'Hasil Perhitungan Pruning',
			'latih' => Session::get('dataUpdate')
		];
		$this->perhitungan(true, $data['latih']);
		$prediction = $this->prediction($data['latih'], $this->Kondisi);
		foreach ($data['latih'] as $key => $value) {
			$data['latih'][$key]['hasil'] = $prediction[$key];
		}
		return view('latih/hasilperhitunganpruning', $data);
	}

	public function hasilperhitunganawal()
	{

		$data = [
			'title' => 'Hasil Perhitungan Awal',
			'latih' => Session::get('dataUpdate')
		];
		$this->perhitungan(false, $data['latih']);
		$prediction = $this->prediction($data['latih'], $this->Kondisi);
		foreach ($data['latih'] as $key => $value) {
			$data['latih'][$key]['hasil'] = $prediction[$key];
		}
		return view('latih/hasilperhitunganawal', $data);
	}

	public function boosting(Request $request)
	{
		// if ($request->input('boosting') == 'update') {
		// 	$latihPoisonous = (int) round(85 / 100 * count($this->filterDataPoisonous));
		// 	$latihEdible = (int) round(85 / 100 * count($this->filterDataEdible));

		// 	$dataAcak = array_merge($this->filterDataPoisonous->random($latihPoisonous)->toArray(), $this->filterDataEdible->random($latihEdible)->toArray());
		// 	Session::put('dataUpdate', $dataAcak);
		// }

		$dataHasilAcak = Session::get('dataUpdate');

		$data = [
			'title' => 'Hasil Boosting',
			'latih' => $dataHasilAcak
		];
		$this->perhitungan(true, $dataHasilAcak);

		$prediction = $this->prediction($dataHasilAcak, $this->Kondisi);
		$predictionBenar = 0;
		$predictionSalah = 0;

		foreach ($dataHasilAcak as $key => $value) {
			// var_dump($value);
			// return;
			if ($value['class'] == $prediction[$key]) {
				$predictionBenar++;
			} else {
				$predictionSalah++;
			}
		}
		// var_dump($predictionEdible);
		// return;
		// // return $prediction;
		foreach ($data['latih'] as $key => $value) {
			$data['latih'][$key]['hasil'] = $prediction[$key];
		}
		$dataTrainingHitung = collect($dataHasilAcak);

		$hasilEdible = $dataTrainingHitung->where('class', '=', 'Edible')->count();
		$hasilPoisonous = $dataTrainingHitung->where('class', '=', 'Poisonous')->count();

		$total = $hasilEdible + $hasilPoisonous;
		$hasilAkurasi = ($predictionBenar / $total) * 100;
		$bobot = 1 / $total;
		$Splus = $predictionBenar * $bobot;
		$Smin = $predictionSalah * $bobot;
		$midpoint = (1 / 4) * ($Splus - $Smin);
		$WKbenar = $bobot * (($Splus - $midpoint) / $Splus);
		$WKsalah = $bobot + ($midpoint / $predictionSalah);
		// $totalHasil = $hasilEdible + $hasilPoisonous;
		// var_dump($dataTraining);
		// var_dump($totalHasil, $predictionEdible, $predictionPoisonous);
		// return;
		return view('latih/boosting', $data, [
			'predictionBenar' => $predictionBenar,
			'predictionSalah' => $predictionSalah,
			'hasilEdible' => $hasilEdible,
			'hasilPoisonous' => $hasilPoisonous,
			'total' => $total,
			'hasilAkurasi' => $hasilAkurasi,
			'bobot' => $bobot,
			'Splus' => $Splus,
			'Smin' => $Smin,
			'midpoint' => $midpoint,
			'WKbenar' => $WKbenar,
			'WKsalah' => $WKsalah
		]);
	}

	public function pembagianData()
	{
		$dataHasilAcak = Session::get('dataUpdate');
		$data = [
			'title' => 'Hasil Boosting',
			'latih' => $dataHasilAcak
		];
		$this->perhitungan(true, $dataHasilAcak);

		$prediction = $this->prediction($dataHasilAcak, $this->Kondisi);
		$predictionBenar = 0;
		$predictionSalah = 0;

		foreach ($dataHasilAcak as $key => $value) {
			// var_dump($value);
			// return;
			if ($value['class'] == $prediction[$key]) {
				$predictionBenar++;
			} else {
				$predictionSalah++;
			}
		}
		var_dump($predictionSalah);
	}


	public function prosesboosting()
	{
		$boost	= null;
		$data	= [];
		if (Session::get('status') === 'boost') {
			if (Session::get('update')) {
				$akurasiTerbaik	= 0;
				$a				= 1;
				$latihPoisonous	= (int) round(85 / 100 * count($this->filterDataPoisonous));
				$latihEdible	= (int) round(85 / 100 * count($this->filterDataEdible));
				while ($a <= 20) {
					$dataAcak = array_merge($this->filterDataPoisonous->random($latihPoisonous)->toArray(), $this->filterDataEdible->random($latihEdible)->toArray());

					$this->perhitungan(true, $dataAcak);

					$prediction = $this->prediction($dataAcak, $this->Kondisi);
					$predictionBenar = 0;
					$total = 0;

					foreach ($dataAcak as $key => $value) {
						if ($value['class'] == $prediction[$key]) {
							$predictionBenar++;
						}
						$total++;
					}
					$hasilAkurasi	= ($predictionBenar / $total) * 100;

					Session::put('semuaHasilAkurasi.' . $a, $hasilAkurasi);
					if ($akurasiTerbaik < $hasilAkurasi) {
						$akurasiTerbaik	= $hasilAkurasi;
						Session::put('dataUpdate', $dataAcak);
					}
					$a++;
				}
			}
			$data['labels']			= array_keys(Session::get('semuaHasilAkurasi'));
			$data['data']			= array_values(Session::get('semuaHasilAkurasi'));
			$data['semuaAkurasi']	= Session::get('semuaHasilAkurasi');
			$boost					= Session::get('status');
		}
		return view('prosesboosting', [
			'title' => 'Proses Boosting',
			'boost'	=> $boost,
			'data'	=> $data
		]);
	}



	public function panggil()
	{
		$this->perhitungan(true, Session::get('dataUpdate'));
		$data = $this->getAttribute();
		return view('latih.perhitunganpruning', ['data' => $this->allData, 'title' => 'Perhitungan Pruning', 'isi' => $data]);
	}


	public function prediction($data, $Kondisi)
	{
		$result = array_map(function ($data) use ($Kondisi) {
			foreach ($Kondisi as $condition) {
				foreach ($condition as $key => $value) {
					if ($key === 'class') {
						return $value;
					}
					if ($data[$key] !== $value) {
						break;
					}
				}
			}
		}, $data);

		return $result;
	}

	public function getDataLatih()
	{
		$ambilLatih = $this->allDataModel->take(4794)->all();
		$ambilLatih = array_map(function ($value) {
			return (array)$value;
		}, $ambilLatih);
		return collect($ambilLatih);
	}

	public function getDataTest()
	{
		$dataSet =  collect($this->LatihModel->allData());
		$a = $dataSet->count();

		$ambilLatih = collect($this->allDataModel->take(4794)->all());
		$b = $ambilLatih->count();

		$ambilTest = $this->allDataModel->take($a - $b)->all();
		$ambilTest = array_map(function ($value) {
			return (array)$value;
		}, $ambilTest);
		return collect($ambilTest);
	}

	public function filterData($data, $condition)
	{
		$filteredData = $data->filter(function ($item) use ($condition) {
			foreach ($condition as $key => $value) {
				if ($item[$key] !== $value) {
					return false;
				}
			}
			return true;
		});
		return $filteredData;
	}

	public function identifikasi()
	{
		$this->perhitungan(true, Session::get('dataUpdate'));
		$data = $this->getAttribute();
		return view('identifikasi', ['data' => $this->allData, 'title' => 'Proses Identifikasi', 'isi' => $data]);
	}

	public function prosesidentifikasi(Request $request)
	{
		$dataForm[] = Arr::except($request, '_token');
		$this->Kondisi = [];
		$this->perhitungan(true, Session::get('dataUpdate'));
		$hasilUji = $this->prediction($dataForm, $this->Kondisi);
		return view('identifikasi', ['hasil' => $hasilUji[0], 'title' => 'Proses Identifikasi']);
	}


	// public function updateboosting(Request $request){

	// }

	public function getAttribute()
	{
		$attribute = [];
		$attrMushroomValue = [];
		$data = $this->LatihModel->allData();
		foreach ($data as $perData) {
			foreach ($perData as $key => $value) {
				if (!isset($attribute[$key][$value])) {
					$attribute[$key][$value] = 0;
					if ($key !== 'class') {
						$attrMushroomValue[$key][$value] = [];
					}
				}
			}
		}
		$data = ['attribute' => $attribute, 'attrMushroomValue' => $attrMushroomValue];
		return $data;
	}


	public function perhitungan($hasPruning = false, $dataTerbaru, $condition = [], $hasil = null)
	{
		// return;
		if ($hasil != null) {
			if ($hasil['key'] != null) {
				$condition[$hasil['key']] = $hasil['value'];
				$this->Kondisi[] = $condition;
				// var_dump($condition);
				return;
			}
		}

		// $condition = [
		// 	'odor' => 'None',
		// 	'veil-color' => 'White',
		// 	'ring-number' => "Two",
		// ];
		$dataLatih = $this->filterData(collect($dataTerbaru), $condition);
		// return $dataLatih;
		$data = [
			'title' => 'Perhitungan',
			'nilaiMaxGain' => 0,
			'attrNilaiMaxGain' => null
		];
		$procesedDataLatih = [];
		$globalCounter = [
			'totalData' => 0,
			'totalEdible' => 0,
			'totalPoisonous' => 0,
			'entropy' => 0
		];
		$entropyTotals = [];
		$informationGains = [];
		foreach ($dataLatih as $item) {
			// return $item;
			$globalCounter['totalData']++;
			$edibleOrPoisonus = $item['class'];
			if ($edibleOrPoisonus == 'Edible') {
				$globalCounter['totalEdible']++;
			} else {
				$globalCounter['totalPoisonous']++;
			}
			// var_dump($item);
			foreach ($item as $prop => $value) {
				// var_dump($prop);
				if ($prop != 'class') {
					if (!isset($procesedDataLatih[$prop])) {
						$procesedDataLatih[$prop] = [];
						if (!isset($procesedDataLatih[$prop][$value])) {
							$procesedDataLatih[$prop][$value] = [];
							$procesedDataLatih[$prop][$value]['total'] = 1;
							if (!isset($procesedDataLatih[$prop][$value][$edibleOrPoisonus])) {
								$procesedDataLatih[$prop][$value][$edibleOrPoisonus] = 1;
							} else {
								$procesedDataLatih[$prop][$value][$edibleOrPoisonus]++;
							}
						} else {
							$procesedDataLatih[$prop][$value]['total']++;
							if (!isset($procesedDataLatih[$prop][$value][$edibleOrPoisonus])) {
								$procesedDataLatih[$prop][$value][$edibleOrPoisonus] = 1;
							} else {
								$procesedDataLatih[$prop][$value][$edibleOrPoisonus]++;
							}
						}
					} else {
						if (!isset($procesedDataLatih[$prop][$value])) {
							$procesedDataLatih[$prop][$value] = [];
							$procesedDataLatih[$prop][$value]['total'] = 1;
							if (!isset($procesedDataLatih[$prop][$value][$edibleOrPoisonus])) {
								$procesedDataLatih[$prop][$value][$edibleOrPoisonus] = 1;
							} else {
								$procesedDataLatih[$prop][$value][$edibleOrPoisonus]++;
							}
						} else {
							$procesedDataLatih[$prop][$value]['total']++;
							if (!isset($procesedDataLatih[$prop][$value][$edibleOrPoisonus])) {
								$procesedDataLatih[$prop][$value][$edibleOrPoisonus] = 1;
							} else {
								$procesedDataLatih[$prop][$value][$edibleOrPoisonus]++;
							}
						}
					}
				}
			}
		}
		// var_dump($dataLatih);
		// return;

		$globalCounter['entropy'] = - ($globalCounter['totalPoisonous'] / $globalCounter['totalData']) * log($globalCounter['totalPoisonous'] / $globalCounter['totalData'], 2) + (- ($globalCounter['totalEdible'] / $globalCounter['totalData']) * log($globalCounter['totalEdible'] / $globalCounter['totalData'], 2));
		if (is_nan($globalCounter['entropy'])) $globalCounter['entropy'] = 0;

		foreach ($procesedDataLatih as $attr => $item) {
			$splitInfoTotal = 0;
			foreach ($item as $key => $value) {
				$total = $value['total'];
				$edible = isset($value['Edible']) ? $value['Edible'] : 0;
				$poisonous = isset($value['Poisonous']) ? $value['Poisonous'] : 0;
				$entropy = 0;
				if ($total > 0) {
					$entropy = - ($poisonous / $total) * log($poisonous / $total, 2) + (- ($edible / $total) * log($edible / $total, 2));
				}
				if (is_nan($entropy)) $entropy = 0;
				$procesedDataLatih[$attr][$key]['entropy'] = $entropy;
				$entropyTotal = isset($entropyTotals[$attr]) ? $entropyTotals[$attr] : 0;
				$entropyTotal += $total / $globalCounter['totalData'] * $entropy;
				$entropyTotals[$attr] = $entropyTotal;

				$splitInfo = 0;
				if ($total > 0) {
					$splitInfo = - ($total / $globalCounter['totalData']) * log($total / $globalCounter['totalData'], 2);
				}
				$splitInfoTotal = $splitInfoTotal + $splitInfo;

				// echo $entropy."<br />";
			}
			$informationGain = 0;
			$informationGain = $globalCounter['entropy'] - $entropyTotals[$attr];
			$informationGains[$attr] = $informationGain;
			$splitInfos[$attr] = $splitInfoTotal;
			if ($informationGain == 0) {
				$gainRatio[$attr] = 0;
			} else {
				$gainRatio[$attr] = $informationGain / $splitInfoTotal;
			}
			// return $gainRatio[$attr];

			if ($data['nilaiMaxGain'] < $gainRatio[$attr]) {
				$data['nilaiMaxGain'] = $gainRatio[$attr];
				$data['attrNilaiMaxGain'] = $attr;
			}
			// return $data['nilaiMaxGain'];

		}


		$data['procesedDataLatih'] = $procesedDataLatih;
		$data['entropyTotals'] = $entropyTotals;
		$data['informationGains'] = $informationGains;
		// return $data['informationGains'];
		$data['splitInfos'] = $splitInfos;
		$data['gainRatio'] = $gainRatio;

		// var_dump($data['attrNilaiMaxGain']);
		// return;
		$countStatus = [];
		foreach ($procesedDataLatih[$data['attrNilaiMaxGain']] as $key => $value) {
			foreach ($value as $attr => $isi) {
				if (!isset($countStatus[$attr])) {
					$countStatus[$attr] = $isi;
				} else {
					$countStatus[$attr] = $countStatus[$attr] + $isi;
				}
			}
			// var_dump($key);
			// return;
		}

		if ($hasPruning == true) {
			$newCountStatus = $countStatus;
			unset($newCountStatus['entropy']);
			$salahPrediksi = min($newCountStatus);

			foreach ($procesedDataLatih[$data['attrNilaiMaxGain']] as $key => $value) {

				$nilaiError[$key] = 0;
				if ($value['entropy'] == 0) continue;
				$nilaiTerkecil = null;
				// var_dump($value);
				// return;
				foreach ($value as $isi => $nilai) {
					if (is_null($nilaiTerkecil) && $isi != 'entropy') {
						$nilaiTerkecil = $nilai;
					} elseif ($nilaiTerkecil > $nilai && $isi != 'entropy') {
						$nilaiTerkecil = $nilai;
					}
				}

				$nilaiError[$key] = $this->pruning($nilaiTerkecil, $value['total']);
			}
			// var_dump($countStatus);
			// return;

			$nilaiError['ParentNode'] = $this->pruning($salahPrediksi, $countStatus['total']);
			// var_dump($nilaiError);
			// return;
			// return;
			// var_dump($salahPrediksi);
			// return;
		}




		//Proses Rekursif
		$hasil = [
			'key' => null,
			'value' => null
		];
		// var_dump($procesedDataLatih[$data['attrNilaiMaxGain']]);
		// return;
		$this->allData[] = $data;
		foreach ($procesedDataLatih[$data['attrNilaiMaxGain']] as $key => $value) {
			// var_dump($value);
			$hasil = [
				'key' => null,
				'value' => null
			];
			// var_dump($nilaiError['ParentNode']);
			// var_dump($nilaiError[$key]);
			// return;
			$condition[$data['attrNilaiMaxGain']] = $key;
			$leaf = false;
			if (isset($nilaiError[$key]['hasil'])) {
				if ($nilaiError['ParentNode']['hasil'] < $nilaiError[$key]['hasil']) {
					$newCabang = $value;
					unset($newCabang['total']);
					$hasil['value'] = array_search(max($newCabang), $newCabang);
					$hasil['key'] = 'class';
					$leaf = true;
				}
			}
			if ($leaf != true) {
				if (isset($value['Edible']) && !isset($value['Poisonous'])) {
					$hasil['value'] = 'Edible';
					$hasil['key'] = 'class';
				} elseif (isset($value['Poisonous']) && !isset($value['Edible'])) {
					$hasil['value'] = 'Poisonous';
					$hasil['key'] = 'class';
				} elseif (!isset($value['Edible'])  && !isset($value['Poisonous'])) {
					$hasil = [
						'key' => 'null',
						'value' => 'null'
					];
				}
			}
			// var_dump($procesedDataLatih[$data['attrNilaiMaxGain']]);
			// var_dump($condition);
			// return;


			// var_dump($condition, $hasil);
			$this->perhitungan($hasPruning, $dataTerbaru, $condition, $hasil);
		}

		return;

		// var_dump($data['gainRatio']);
		// return;
		// var_dump($entropyTotals);
		return $data;
		return view('latih.perhitungan', $data);
	}

	public function pruning($salahPrediksi, $jumlahPrediksi)
	{
		$N = $jumlahPrediksi;
		$f = $salahPrediksi;
		$false = $f / $N;
		$z = -0.67;


		$a = (pow($z, 2)) / (2 * $N);
		// $e = sqrt(($false / $N) - ((pow($false, 2)) / $N) + ((pow($z, 2)) / (4 * (pow($N, 2)))));
		$b = $z * (sqrt(($false / $N) - ((pow($false, 2)) / $N) + ((pow($z, 2)) / (4 * (pow($N, 2))))));
		$c = 1 + ((pow($z, 2)) / $N);
		// $hasil = $false + $a + ($b / $c);
		$hasil = ($false + $a + $b) / $c;
		// return $e;
		return [
			'N' => $N,
			'f' => $f,
			'z' => $z,
			'a' => $a,
			'b' => $b,
			'c' => $c,
			'hasil' => $hasil,
		];
	}
}
