<?php

use Illuminate\Support\Facades\URL;

class Cv extends Eloquent {

    /**
     * Deletes a cv and all
     * the associated comments.
     *
     * @return bool
     */
    public function delete() {
        // Delete the cv
        return parent::delete();
    }

    /**
     * Returns a formatted post content entry,
     * this ensures that line breaks are returned.
     *
     * @return string
     */
    public function summary() {
        return nl2br($this->summary);
    }

    /**
     * Get the post's author.
     *
     * @return User
     */
    public function owner() {
        return $this->belongsTo('User', 'user_id');
    }

    /**
     * Get the post's comments.
     *
     * @return array
     */
    public function status() {
        return $this->status;
    }

    /**
     * Get the date the post was created.
     *
     * @param \Carbon|null $date
     * @return string
     */
    public function date($date = null) {
        if (is_null($date)) {
            $date = $this->created_at;
        }

        return String::date($date);
    }

    /**
     * Get the URL to the post.
     *
     * @return string
     */
    public function url() {
        return Url::to($this->slug);
    }

    /**
     * Returns the date of the cv creation,
     * on a good and more readable format :)
     *
     * @return string
     */
    public function created_at() {
        return $this->date($this->created_at);
    }

    /**
     * Returns the date of the cv last update,
     * on a good and more readable format :)
     *
     * @return string
     */
    public function updated_at() {
        return $this->date($this->updated_at);
    }

}
