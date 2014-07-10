<?php

class ResumeController extends BaseController {

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param Post $resume
     * @param User $user
     */
    public function __construct(Resume $resume, User $user) {
        parent::__construct();

        $this->resume = $resume;
        $this->user = $user;
    }

    /**
     * Returns all the resume posts.
     *
     * @return View
     */
    public function getIndex() {
        // Get all the resume posts
        $resumes = $this->resume->orderBy('created_at', 'DESC')->paginate(10);

        // Show the page
        return View::make('site/resume/index', compact('resumes'));
    }

    /**
     * View a resume post.
     *
     * @param  string  $slug
     * @return View
     * @throws NotFoundHttpException
     */
    public function getView($slug) {
        // Get this resume post data
        $post = $this->post->where('slug', '=', $slug)->first();

        // Check if the resume post exists
        if (is_null($post)) {
            // If we ended up in here, it means that
            // a page or a resume post didn't exist.
            // So, this means that it is time for
            // 404 error page.
            return App::abort(404);
        }

        // Get this post comments
        $comments = $post->comments()->orderBy('created_at', 'ASC')->get();

        // Get current user and check permission
        $user = $this->user->currentUser();
        $canComment = false;
        if (!empty($user)) {
            $canComment = $user->can('post_comment');
        }

        // Show the page
        return View::make('site/resume/view_post', compact('post', 'comments', 'canComment'));
    }

    /**
     * View a resume post.
     *
     * @param  string  $slug
     * @return Redirect
     */
    public function postView($slug) {

        $user = $this->user->currentUser();
        $canComment = $user->can('post_comment');
        if (!$canComment) {
            return Redirect::to($slug . '#comments')->with('error', 'You need to be logged in to post comments!');
        }

        // Get this resume post data
        $post = $this->post->where('slug', '=', $slug)->first();

        // Declare the rules for the form validation
        $rules = array(
            'comment' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            // Save the comment
            $comment = new Comment;
            $comment->user_id = Auth::user()->id;
            $comment->content = Input::get('comment');

            // Was the comment saved with success?
            if ($post->comments()->save($comment)) {
                // Redirect to this resume post page
                return Redirect::to($slug . '#comments')->with('success', 'Your comment was added with success.');
            }

            // Redirect to this resume post page
            return Redirect::to($slug . '#comments')->with('error', 'There was a problem adding your comment, please try again.');
        }

        // Redirect to this resume post page
        return Redirect::to($slug)->withInput()->withErrors($validator);
    }

}
