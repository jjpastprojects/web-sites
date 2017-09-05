<?php

 namespace Lembarek\ShareFiles\Controllers;

use View;
use Redirect;
use Illuminate\Http\Request;
use Lembarek\ShareFiles\Controllers\Controller;
use Lembarek\ShareFiles\Requests\AddFileRequest;
use Lembarek\ShareFiles\Repositories\FileRepositoryInterface;

class FilesController extends Controller
{

    protected $fileRepo;


    public function __construct(FileRepositoryInterface $fileRepo)
    {
        $this->fileRepo = $fileRepo;
    }


    /**
     * show all files
     *
     * @return Response
     */
    public function index()
    {
         return View::make('shareFiles::files.index');
    }


    /**
     * search
     *
     * @return Response
     */
    public function search(Request $request)
    {
        $q = $request->get('q');
        $files  = $this->fileRepo->search($q);
        $statistics  = getStatistics($files, ['universities', 'faculty', 'filetype', 'semester', 'year', 'country', ]);
        return view::make('shareFiles::files.search', compact('files', 'statistics', 'parameters'));
    }


    /**
     * show the form to add a files
     *
     * @return Response
     */
    public function create()
    {
        return view('shareFiles::files.create');
    }


    /**
     * a save the file in DB
     *
     * @return void
     */
    public function store(AddFileRequest $request)
    {
        $inputs = $request->except('_token');

        $inputs['slug'] = str_slug($inputs['name'], '_');

        $this->fileRepo->create($inputs);

        return Redirect::back()->with(['flash.message' => trans('file.add_success')]);

    }


    /**
     * show detail about a file
     *
     * @param  string  $slug
     * @return Response
     */
    public function show($slug)
    {
        $file = $this->fileRepo->getFileBySlug($slug);
        return view('shareFiles::files.show', compact('file'));
    }
}
