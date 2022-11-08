<?php
    
namespace App\Http\Controllers;
    
use App\Models\Prize;
use Illuminate\Http\Request;
    
class PrizeController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:prize-list|prize-create|prize-edit|prize-delete', ['only' => ['index','show']]);
         $this->middleware('permission:prize-create', ['only' => ['create','store']]);
         $this->middleware('permission:prize-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:prize-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prizes = Prize::latest()->paginate(5);
        return view('prizes.index',compact('prizes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prizes.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'image_path' => 'required',
        ]);
    
        Prize::create($request->all());
    
        return redirect()->route('prizes.index')
                        ->with('success','Prize created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function show(Prize $prize)
    {
        return view('prizes.show',compact('prize'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function edit(Prize $prize)
    {
        return view('prizes.edit',compact('prize'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prize $prize)
    {
         request()->validate([
            'name' => 'required',
            'image_path' => 'required',
        ]);
    
        $prize->update($request->all());
    
        return redirect()->route('prizes.index')
                        ->with('success','Prize updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prize  $prize
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prize $prize)
    {
        $prize->delete();
    
        return redirect()->route('prizes.index')
                        ->with('success','Prize deleted successfully');
    }
}
