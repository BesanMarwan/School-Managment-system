<?php 

namespace App\Http\Controllers\Grades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Http\Requests\GradeRequest;


class GradeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $Grades = Grade::all();
    return view('pages.Grades.index',compact('Grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(GradeRequest $request)
  {
    try{
    $grade =Grade::create([
      'Name'  => [
         'en' => $request->Name_en,
         'ar' => $request->Name,
      ],
      'Notes' => $request->Notes,
   ]);
  if(!$grade){
    toastr()->error(__('message.Failure'));
    return redirect()->route('Grades.index');
   }
   toastr()->success(__('message.success'));
   return redirect()->route('Grades.index');
    }catch(\Exception $e){
      return redirect()->back()->with(['error'=>$e->getMessage()]);
    }

    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(GradeRequest $request,$id)
  {
    try{
      $grades = Grade::FindOrFail($request->id);
      if(! $grades){
        toastr()->danger(__('message.NotFound'));
        return redirect()->route('Grades.index');
       }
       $grades->update([
        'Name'  => [
           'en' => $request->Name_en,
           'ar' => $request->Name,
        ],
        'Notes' => $request->Notes,
     ]);
       toastr()->success(__('message.update'));
       return redirect()->route('Grades.index');
        }catch(\Exception $e){
          return redirect()->back()->with(['error'=>$e->getMessage()]);
        }
    
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request,$id)
  {
    $grades = Grade::FindOrFail($request->id)->delete();
     toastr()->error(__('message.delete'));
       return redirect()->route('Grades.index');
    
  }
  
}

?>
  