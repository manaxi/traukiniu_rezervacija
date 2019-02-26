<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Train;
use App\Booking;
use DB;
class TrainsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trains = Train::orderBy('arrival_city','desc')->paginate(10);
        return view('trains.index')->with('trains', $trains);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trains.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'departure_city' => 'required',
            'arrival_city' => 'required',
            'ticket_price' => 'required',
            'total_seats' => 'required|integer|min:1'
        ]);

        //Create Train Schedule
        $train = new Train;
        $train->departure_city = $request->input('departure_city');
        $train->arrival_city = $request->input('arrival_city');
        $train->departure_data=$request->input('departure_data');
        $train->arrival_data=$request->input('arrival_data');
        $train->ticket_price=$request->input('ticket_price');
        $train->total_seats=$request->input('total_seats');
        $train->save();
        return redirect('/trains')->with('sucess', 'Train Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $train=Train::find($id);

         //Making array for available seat numbers
         $booking_info = DB::table('booking')->where('train_id',$id)->where('status',1)->get();
         $busy_seat_array=[];
         if(count($booking_info) > 0 ){
             foreach( $booking_info as $value){
                 array_push($busy_seat_array,$value->seat_no);
             }
         }       
        return view('trains.show', ['train' => $train, 'busy_seats' => $busy_seat_array]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $train=Train::find($id);
        return view('trains.edit')->with('train', $train);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'departure_city' => 'required',
            'arrival_city' => 'required',
            'total_seats' => 'required|integer|min:1',
            'arrival_data' =>'required',
        
        ]);

        //Create Train Schedule
        $train =Train::find($id);
        $train->departure_city = $request->input('departure_city');
        $train->arrival_city = $request->input('arrival_city');
        $train->departure_data=$request->input('departure_data');
        $train->arrival_data=$request->input('arrival_data');
        $train->ticket_price=$request->input('ticket_price');
        $train->total_seats=$request->input('total_seats');
        $train->save();
        return redirect('/trains')->with('sucess','Traukinys atnaujintas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $train=Train::find($id);
        $train->delete();
        return redirect('/trains')->with('success', 'Traukinys ištrintas');
    }

    public function destroyBooking($id)
    {
        $booking=Booking::find($id);
        $booking->delete();
        return redirect('/trains')->with('success', 'Rezervacija atšaukta');
    }

    public static function getAvailableSeat($id)
    {
        $train=Train::find($id);
        $total_seat=$train->total_seats;
        $booked_seat=DB::table('booking')->where('train_id',$id)->count();
        return $total_seat-$booked_seat;
    }

    public static function getTrainPrice($id){
        $train=Train::find($id);
        $price=DB::table('booking')->where('train_id',$id)->sum('ticket_price');
        return $price;
    }
    public static function totalPrice(){
        $totalPrice=DB::table('booking')->where('status',1)->sum('ticket_price');
        return $totalPrice;  
    }
    public function bookingNow(Request $request)
    {
        $this->validate($request, [
            'seat_no' => 'required'
        ]);
        $check = DB::table('booking')
                    ->where('train_id',  $request->input('train_id'))
                    ->where('seat_no', $request->input('seat_no'))
                    ->where('ticket_price', $request->input('ticket_price'))
                    ->where('status', 1)
                    ->count();
        if($check == 0)
        {
            //Add booking
            $booking = new Booking;
            $booking->user_id = auth()->user()->id;
            $booking->seat_no = $request->input('seat_no');
            $booking->train_id = $request->input('train_id');
            $booking->ticket_price = $request->input('ticket_price');
            $booking->status = $request->input('status');  
            $booking->save();
            return redirect('/trains')->with('success', 'Traukinio vieta užsakyta');  
        }else{
             return redirect('/trains')->with('error', 'Seat is already booked');
        }
    }
}
