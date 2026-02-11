<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // Путь к файлу хранения - просто имя файла
    private $storageFile = 'cars.json';
    
    /**
     * Отображает главную страницу с формой
     */
    public function index()
    {
        return view('cars.form');
    }
    
    /**
     * Сохраняет новую машину в файл
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
            'color' => 'required|string|max:30',
            'engine_volume' => 'required|numeric|min:0.5|max:10',
            'transmission' => 'required|in:automatic,manual',
            'fuel_type' => 'required|in:petrol,diesel,electric,hybrid',
            'mileage' => 'nullable|integer|min:0',
            'vin' => 'nullable|string|size:17|alpha_num',
        ]);
        
        $carData = $validated;
        $carData['id'] = uniqid();
        $carData['created_at'] = date('Y-m-d H:i:s');
        
        try {
            // Используем disk('local') для работы с storage/app
            $cars = [];
            if (Storage::disk('local')->exists($this->storageFile)) {
                $content = Storage::disk('local')->get($this->storageFile);
                $cars = json_decode($content, true) ?? [];
            }
            
            $cars[] = $carData;
            
            // Сохраняем через disk('local')
            Storage::disk('local')->put(
                $this->storageFile, 
                json_encode($cars, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            );
            
            return redirect()->route('cars.index')
                ->with('success', 'Автомобиль успешно сохранен! ID: ' . $carData['id']);
                
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Ошибка при сохранении: ' . $e->getMessage());
        }
    }
    
    /**
     * Ищет машины по параметрам
     */
    public function search(Request $request)
    {
        // Получаем ВСЕ параметры поиска, но не требуем их заполнения
        $searchParams = $request->only([
            'brand', 'model', 'year', 'color', 'transmission', 'fuel_type',
            'price', 'engine_volume', 'mileage'
        ]);
        
        // Удаляем пустые значения и нулевые
        $searchParams = array_filter($searchParams, function($value) {
            return $value !== '' && $value !== null;
        });
        
        try {
            $cars = [];
            if (Storage::disk('local')->exists($this->storageFile)) {
                $content = Storage::disk('local')->get($this->storageFile);
                $cars = json_decode($content, true) ?? [];
            }
            
            if (empty($searchParams)) {
                // Если нет параметров поиска, показываем все
                $results = $cars;
            } else {
                // Ищем по заполненным полям
                $results = array_filter($cars, function ($car) use ($searchParams) {
                    foreach ($searchParams as $key => $value) {
                        // Пропускаем пустые значения
                        if ($value === '' || $value === null) {
                            continue;
                        }
                        
                        // Для числовых полей точное сравнение
                        if (in_array($key, ['year', 'price', 'engine_volume', 'mileage'])) {
                            if ($car[$key] != $value) {
                                return false;
                            }
                        }
                        // Для текстовых полей - частичное совпадение (без учета регистра)
                        elseif (in_array($key, ['brand', 'model', 'color'])) {
                            if (stripos($car[$key], $value) === false) {
                                return false;
                            }
                        }
                        // Для select полей - точное совпадение
                        elseif (in_array($key, ['transmission', 'fuel_type'])) {
                            if ($car[$key] != $value) {
                                return false;
                            }
                        }
                    }
                    return true;
                });
                
                $results = array_values($results);
            }
            
            return view('cars.list', [
                'cars' => $results,
                'searchParams' => $searchParams,
                'totalFound' => count($results)
            ]);
            
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Ошибка при поиске: ' . $e->getMessage());
        }
    }
}
