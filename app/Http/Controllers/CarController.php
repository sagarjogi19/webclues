<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constants\ResponseMessage;
use App\Car;
use App\Traits\ImgaeUpload;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CarResource;

class CarController extends Controller {

    use ImgaeUpload;

    public function __construct() {
        $this->responseMessage = app()->make('ResponseMessage');
    }

    /**
     * Display a listing of the car resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Car::orderBy('id','desc')->get();

            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('color', function($row) {
                                return config('cars.color_value')[$row->color];
                            })
                            ->addColumn('make_date', function($row) {
                                return date('d-m-Y', strtotime($row->make_date));
                            })
                            ->addColumn('is_active', function($row) {
                                return ($row->is_active == 1) ? 'Active' : 'Inactive';
                            })
                            ->addColumn('action', function($row) {
                                $btn = '<a href="' . route('admin.cars.edit', be64($row->id)) . '" id="edit-car" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>&nbsp;<a href="' . route('admin.cars.show', be64($row->id)) . '" id="view-car" class="btn btn-xs btn-warning"><i class="fa fa-eye"></i> View</a>';
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
        return view('admin.cars.index');
    }

    /**
     * Show the form for creating a new car resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.cars.create');
    }

    /**
     * Store a newly created car resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $messages = [];
        $rules = array(
            'name' => "required",
            'color' => "required",
            'day' => "required",
            'month' => "required",
            'year' => "required",
            'fuel_type' => "required",
            'description' => "required",
            'is_active' => "required",
        );
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->route('admin.cars.index');
        } else {
            if (isset($input['car_id'])) {
                $car = Car::find(bd64($input['car_id']));
            }
            // check for file and add name in request
            if (isset($request->icon) && $request->has('icon')) {
                $image = $request->icon;
                $ext = $image->getClientOriginalExtension();
                if (in_array($ext, ["jpg", "gif", "jpeg", "png", "bmp"])) {
                    $imageName = $this->imageUploder($request->icon,'', 'icons');
                    $input["icon"] = $imageName;
                }
            }
            $input['make_date'] = $input['year'] . '-' . $input['month'] . '-' . $input['day'];
            $input = Arr::except($input, ['_token', 'car_id', 'day', 'month', 'year']);
            if (isset($car)) {
                $car->fill($input)->save();
            } else {
                $car = Car::create($input);
            }
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $key => $files) {
                    $extension = $files->getClientOriginalExtension();
                    if (in_array($extension, ["jpg", "gif", "jpeg", "png", "bmp"])) {
                        $imageName = $this->imageUploder($files, '', 'images');
                        $car->images()->create(['image' => $imageName]);
                    }
                }
            }
            return response()->success($this->responseMessage::CAR_SAVE_SUCCESS, '');
        }
    }

    /**
     * Display the specified car resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $car = Car::with('images')->whereId(bd64($id))->first();
        return view('admin.cars.show', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified car resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $car = Car::find(bd64($id));
        return view('admin.cars.create', ['car' => $car]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    /**
     * Fetch all cars and show on map
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function viewMap() {
        $cars = Car::where('is_active', '1')->get();
        $data = CarResource::collection($cars);

        $cardata = json_encode($data);
        return view('admin.view_map')->with(compact('cardata'));
    }

}
