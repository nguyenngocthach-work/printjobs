<?php

namespace App\Http\Controllers;
use App\Jobs;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tag;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index( Request $request)
    {
        $location =  config('const.location');
        $parentJobs = Jobs::where('archived', '=', 0)
            ->where('parent_id', '=', 0)
            ->orderBy('updated_at', 'DESC')
            ->paginate(20);

        $taskParents  = array("");
        if(!empty ($parentJobs)) {
            $k=0;
            foreach ($parentJobs as $job ) {
                $subJob  = array("");
                $subtasks =  Jobs::where('parent_id', '=', $job->id)->get();;

                if(!empty($subtasks) ) {
                    $i = 0;
                    foreach ($subtasks as $subtask ) {

                        $subJob [$i] =  array (
                            'job_id' => $subtask->id,
                            'parent_id' => $subtask->parent_id,
                            'customer' => $subtask->customer,
                            'project_name' => $subtask->project_name,
                            'quantity' => $subtask->quantity,
                            'status' => $subtask->status,
                            'delivery_date' => date('d.m.yy',strtotime($subtask->delivery_date)),
                            'supplier' => $subtask->supplier,
                            'storage' => $location[$subtask->storage_location]
                        );
                        $i++;
                    }
                }

                $taskParents [$k] = array (
                    'job_id' => $job->id,
                    'parent_id' => $job->parent_id,
                    'order_number' => $job->order_number,
                    'customer' => $job->customer,
                    'project_name' => $job->project_name,
                    'quantity' => $job->quantity,
                    'delivery_date' => date('d.m.yy',strtotime($job->delivery_date)),
                    'supplier' => $job->supplier,
                    'status' => $job->status,
                    'storage' => $location[$job->storage_location],
                    'subjob' => $subJob

                );

                $k++;
            }

        }

        if ($request->isMethod('post')) {

            $data = array ("");
            $jobs = new Jobs();
            $this->handleJobUpdate($jobs, $request);

            return true;

        }


        return view('home', [
            'listJob' => $taskParents,
            'parentJobs' =>$parentJobs
        ]);
    }

    private function handleJobUpdate(Jobs $jobs, Request $request) {

        $jobs->fill($request->all());
        if ($request->input('parent_id') > 0 ) {
            $parent_id = $request->input('parent_id') ;
        } else {
            $parent_id = 0;
        }
        $jobs->order_number = $request->input('order_number');
        $jobs->project_name = $request->input('project_name');
        $jobs->supplier = $request->input('supplier');
        $jobs->customer = $request->input('customer');
        $jobs->status = $request->input('status');
        $jobs->parent_id = $parent_id;
        $jobs->delivery_date = date('yy-m-d', strtotime($request->input('delivery_date')));
        $jobs->save();


    }

    /**
     * get jobs archived
     *param: no
     *@return  \Illuminate\Contracts\Support\Renderable
    */
    public function archive () {

        $location =  config('const.location');
        $archives = Jobs::where('archived', '=', 1)
            ->where('parent_id', '=', 0)
            ->orderBy('updated_at', 'DESC')
            ->paginate(20);

        $taskArchs  = array("");
        if(!empty ($archives)) {
            $k=0;
            foreach ($archives as $archive ) {
                   $subJob  = array("");
                   $subtasks =  Jobs::where('parent_id', '=', $archive->id)->get();;

                   if(!empty($subtasks) ) {
                       $i = 0;
                       foreach ($subtasks as $subtask ) {

                           $subJob [$i] =  array (
                               'job_id' => $subtask->id,
                               'parent_id' => $subtask->parent_id,
                               'customer' => $subtask->customer,
                               'project_name' => $subtask->project_name,
                               'quantity' => $subtask->quantity,
                               'delivery_date' => date('d.m.yy',strtotime($subtask->delivery_date)),
                               'supplier' => $subtask->supplier,
                               'storage' => $location[$subtask->storage_location]
                           );
                           $i++;
                       }
                   }

                $taskArchs [$k] = array (
                    'job_id' => $archive->id,
                    'parent_id' => $archive->parent_id,
                    'order_number' => $archive->order_number,
                    'customer' => $archive->customer,
                    'project_name' => $archive->project_name,
                    'quantity' => $archive->quantity,
                    'delivery_date' => date('d.m.yy',strtotime($archive->delivery_date)),
                    'supplier' => $archive->supplier,
                    'storage' => $location[$archive->storage_location],
                    'subjob' => $subJob

                );

                $k++;
            }

        }
        return view('archived', [
            'archived' => $taskArchs,
            'archives' =>$archives
        ]);


    }

    /**
     * create jobs
     *param: no
     *@return  \Illuminate\Contracts\Support\Renderable
     */
    public function createproject () {
        return view('home', [
            'status' => 1,
            'message' =>"OK"
        ]);

    }
}
