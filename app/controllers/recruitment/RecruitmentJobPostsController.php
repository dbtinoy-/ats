<?php

class RecruitmentJobPostsController extends RecruitmentController {

    /**
     * Post Model
     * @var Post
     */
    protected $post;

    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Post $post) {
        parent::__construct();
        $this->post = $post;
    }

    /**
     * Show a list of all the job posts.
     *
     * @return View
     */
    public function getIndex() {
        // Title
        $title = Lang::get('recruitment/job-posts/title.job_management');

        // Grab all the job posts
        $posts = $this->post;

        // Show the page
        return View::make('recruitment/job-posts/index', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate() {
        // Title
        $title = Lang::get('recruitment/job-posts/title.create_a_new_job');

        // Show the page
        return View::make('recruitment/job-posts/create_edit', compact('title'));
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
            'content' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            // Create a new job post
            $user = Auth::user();

            // Update the job post data
            $this->post->title = Input::get('title');
            $this->post->slug = Str::slug(Input::get('title'));
            $this->post->content = Input::get('content');
            $this->post->user_id = $user->id;

            // Was the job post created?
            if ($this->post->save()) {
                // Redirect to the new job post page
                return Redirect::to('recruitment/job-posts/' . $this->post->id . '/edit')->with('success', Lang::get('recruitment/job-posts/messages.create.success'));
            }

            // Redirect to the job post create page
            return Redirect::to('recruitment/job-posts/create')->with('error', Lang::get('recruitment/job-posts/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('recruitment/job-posts/create')->withInput()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param $post
     * @return Response
     */
    public function getShow($post) {
        // redirect to the frontend
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $post
     * @return Response
     */
    public function getEdit($post) {
        // Title
        $title = Lang::get('recruitment/job-posts/title.job_update');

        // Show the page
        return View::make('recruitment/job-posts/create_edit', compact('post', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $post
     * @return Response
     */
    public function postEdit($post) {

        // Declare the rules for the form validation
        $rules = array(
            'title' => 'required|min:3',
            'content' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            // Update the job post data
            $post->title = Input::get('title');
            $post->slug = Str::slug(Input::get('title'));
            $post->content = Input::get('content');

            // Was the job post updated?
            if ($post->save()) {
                // Redirect to the new job post page
                return Redirect::to('recruitment/job-posts/' . $post->id . '/edit')->with('success', Lang::get('recruitment/job-posts/messages.update.success'));
            }

            // Redirect to the job-posts post management page
            return Redirect::to('recruitment/job-posts/' . $post->id . '/edit')->with('error', Lang::get('recruitment/job-posts/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('recruitment/job-posts/' . $post->id . '/edit')->withInput()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function getDelete($post) {
        // Title
        $title = Lang::get('recruitment/job-posts/title.job_delete');

        // Show the page
        return View::make('recruitment/job-posts/delete', compact('post', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function postDelete($post) {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            $id = $post->id;
            $post->delete();

            // Was the job post deleted?
            $post = Post::find($id);
            if (empty($post)) {
                // Redirect to the job posts management page
                return Redirect::to('recruitment/job-posts')->with('success', Lang::get('recruitment/job-posts/messages.delete.success'));
            }
        }
        // There was a problem deleting the job post
        return Redirect::to('recruitment/job-posts')->with('error', Lang::get('recruitment/job-posts/messages.delete.error'));
    }

    /**
     * Show a list of all the job posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData() {
        $posts = Post::select(array('posts.id', 'posts.title', 'posts.id as applicants', 'posts.created_at'));

        return Datatables::of($posts)
                        ->edit_column('applicants', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')
                        ->add_column(
                                'actions', '<div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                              <span class="glyphicon glyphicon-wrench"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                              <li role="presentation"><a role="menuitem" tabindex="-1" class="iframe" href="{{{ URL::to(\'recruitment/job-posts/\' . $id . \'/edit\' ) }}}"><span class=\'glyphicon glyphicon-edit\'></span> {{{ Lang::get(\'button.edit\') }}}</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" class="iframe-small" href="{{{ URL::to(\'recruitment/job-posts/\' . $id . \'/delete\' ) }}}"><span class=\'glyphicon glyphicon-minus\'></span> {{{ Lang::get(\'button.delete\') }}}</a></li>
                            </ul>
                          </div>')
                        ->remove_column('id')
                        ->make();
    }

}
