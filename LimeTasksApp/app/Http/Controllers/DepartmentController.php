<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;


class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with("employees", "projects")->get();

        foreach($departments as $department){
            
            $projects = $department->projects;
            $completedProjects = [];

            foreach($department->projects as $project){

                if($project->status == "Completed") {

                    $completedProjects[] = $project;
                };
            };

            if($completedProjects){

                $department['progress'] = (count($completedProjects) / count($projects)) * 100;
                $department['completed_projects'] = $completedProjects;

            } else {

                $department['progress'] = 0;
            };
        };

        return $departments;
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(){
        //
    }

    public function show($department)
    {
        $department = Department::with("employees", "projects")->find($department);

        $projects = $department->projects;
            $completedProjects = [];

            foreach($department->projects as $project){

                if($project->status == "Completed") {

                    $completedProjects[] = $project;
                };
            };

            if($completedProjects){
                $department['progress'] = (count($completedProjects) / count($projects)) * 100; //Display in percentage
                $department['completed_projects'] = $completedProjects;

            } else {

                $department['progress'] = 0;
            };

        return $department;        
    }

    

}
