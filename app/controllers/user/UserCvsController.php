<?php

class UserCvsController extends BaseController {

    /**
     * Post Model
     * @var Cv
     */
    protected $cv;

    /**
     * Inject the models.
     * @param Cv $cv
     */
    public function __construct(Cv $cv) {
        parent::__construct();
        $this->cv = $cv;
    }

    /**
     * Show a list of all the cvs.
     *
     * @return View
     */
    public function getIndex() {
        
        // Title
        $title = 'My CV';// Lang::get('user/cvs/title.cv_management');

        // Grab all the cvs
        $user = Auth::user();
        $cv = $user->userable()->cv;
        
        

        // Show the page
        return View::make('site/user/cvs/index', compact('cv', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate() {
        // Title
        $title = Lang::get('recruitment/cvs/title.create_a_new_cv');
        $cv = Auth::user()->userable->cv;
        
        // Show the page
        return View::make('site/user/cvs/create_edit', compact('cv','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate() {
        // Declare the rules for the form validation
        $rules = array(
            'title' => 'required|min:3',
            'summary' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            // Create a new cv
            $user = Auth::user();

            // Update the cv data
            $this->cv->title = Input::get('title');
            $this->cv->slug = Str::slug(Input::get('title'));
            $this->cv->summary = Input::get('summary');
            $this->cv->user_id = $user->id;

            // Was the cv created?
            if ($this->cv->save()) {
                // Redirect to the new cv page
                return Redirect::to('user/cvs/' . $this->cv->id . '/edit')->with('success', Lang::get('recruitment/cvs/messages.create.success'));
            }

            // Redirect to the cv create page
            return Redirect::to('user/cvs/create')->with('error', Lang::get('recruitment/cvs/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('user/cvs/index')->withInput()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param $cv
     * @return Response
     */
    public function getShow($cv) {
        // redirect to the frontend
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $cv
     * @return Response
     */
    public function getEdit($cv) {
        // Title
        $title = Lang::get('user/cvs/title.cv_update');

        // Show the page
        return View::make('site/user/cvs/create_edit', compact('cv', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $cv
     * @return Response
     */
    public function postEdit($cv) {

        // Declare the rules for the form validation
        $rules = array(
            'title' => 'required|min:3',
            'summary' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            // Update the cv data
            $cv->title = Input::get('title');
            $cv->slug = Str::slug(Input::get('title'));
            $cv->summary = Input::get('summary');

            // Was the cv updated?
            if ($cv->save()) {
                // Redirect to the new cv page
                return Redirect::to('user/cvs/' . $cv->id . '/edit')->with('success', Lang::get('recruitment/cvs/messages.update.success'));
            }

            // Redirect to the cvs post management page
            return Redirect::to('user/cvs/' . $cv->id . '/edit')->with('error', Lang::get('recruitment/cvs/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('user/cvs/' . $cv->id . '/edit')->withInput()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $cv
     * @return Response
     */
    public function getDelete($cv) {
        // Title
        $title = Lang::get('recruitment/cvs/title.cv_delete');

        // Show the page
        return View::make('recruitment/cvs/delete', compact('cv', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $cv
     * @return Response
     */
    public function postDelete($cv) {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            $id = $cv->id;
            $cv->delete();

            // Was the cv deleted?
            $cv = Post::find($id);
            if (empty($cv)) {
                // Redirect to the cvs management page
                return Redirect::to('recruitment/cvs')->with('success', Lang::get('recruitment/cvs/messages.delete.success'));
            }
        }
        // There was a problem deleting the cv
        return Redirect::to('recruitment/cvs')->with('error', Lang::get('recruitment/cvs/messages.delete.error'));
    }

    /**
     * Show a list of all the cvs formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData() {
        $cvs = Cv::select(array('cvs.id', 'cvs.title', 'cvs.status', 'cvs.created_at'));

        return Datatables::of($cvs)
                        ->add_column(
                            'actions', '<div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                              <span class="glyphicon glyphicon-wrench"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                              <li role="presentation"><a role="menuitem" tabindex="-1" class="iframe" href="{{{ URL::to(\'recruitment/cvs/\' . $id . \'/edit\' ) }}}"><span class=\'glyphicon glyphicon-edit\'></span> {{{ Lang::get(\'button.edit\') }}}</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" class="iframe-small" href="{{{ URL::to(\'recruitment/cvs/\' . $id . \'/delete\' ) }}}"><span class=\'glyphicon glyphicon-minus\'></span> {{{ Lang::get(\'button.delete\') }}}</a></li>
                            </ul>
                          </div>')
                        ->remove_column('id')
                        ->make();
    }

}
