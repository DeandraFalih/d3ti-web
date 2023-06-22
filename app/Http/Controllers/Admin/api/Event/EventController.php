<?php

namespace App\Http\Controllers\Admin\api\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventTagsLink;
use App\Models\Tags;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\FormatPostResource;

class EventController extends Controller
{
    /**
     * 
     * 
     * 
     * CMS
     * 
     * 
     * 
     **/
    

    /**
     * 
     * Event
     * 
     **/

    public function showEvent()
    {
        $data_event = Event::
        where('event_status', '!=', 'trash')
        ->get();

        return [
            'data_event' => $data_event,
        ];
    }

    public function showUserEvent($user_name)
    {
        $data_event = Event::
        where('event_author', $user_name)
        ->where('event_status', '!=', 'trash')
        ->get();

        return [
            'data_event' => $data_event,
        ];
    }

    public function showEventByStatus($status)
    {
        $data_event = Event::
        where('event_status', $status)
        ->get();

        return [
            'data_event' => $data_event,
        ];
    }

    public function createEventForm()
    {
        $data_tags=Tags::all();

        return [
            'data_tags' => $data_tags,
        ];
    }

    public function createEventProcess(Request $request)
    {
        $event = Event::create([
            'event_title' => $request->title,
            'event_featured_image' => $request->featured,
            'event_content' => $request->content,
            'event_date_of_event' => $request->date_of_event,
            'event_excerpt' => $request->excerpt,
            'event_date' => $request->date,
            'event_author' => $request->author,
            'event_link' => $request->link,
            'event_meta' => $request->meta,
            'event_status' => $request->status,
            'event_view' => 0,
        ]);

        $eventId = $event->event_id;
        $tagsIds = $request->tags;

        //Create a new tag record to database
        foreach ($tagsIds as $tagsId) {
            $link = new EventTagsLink();
            $link->event_id = $eventId;
            $link->tags_id = $tagsId;
            $link->save();
        }
    }

    public function editEventForm($event_id)
    {
        $data_event = Event::where('event_id', '=', $event_id)->get();
        $data_tags = Tags::all();

        return [
            'data_event' => $data_event,
            'data_tags' => $data_tags,
        ];
    }

    public function editEventProcess(Request $request, $event_id)
    {
        $db_event = Event::findOrFail($event_id);

        $featured = $request->featured;

        $data = [
            'event_title' => $request->title,
            'event_content' => $request->content,
            'event_date_of_event' => $request->date_of_event,
            'event_excerpt' => $request->excerpt,
            'event_date' => $request->date,
            'event_meta' => $request->meta,
            'event_status' => $request->status,
        ];

        //Check if there is value in the $featured. And if there is, it will update the featured image
        if ($featured != "") {
            $data['event_featured_image'] = $featured;
        }

        //Update the data
        $db_event->update($data);

        $categoryIds = $request->category;
        $tagsIds = $request->tags;

        //Remove current tags record on the database
        EventTagsLink::where('event_id', $event_id)->delete();

        //Create a new tag record to database
        foreach ($tagsIds as $tagsId) {
            $link = new EventTagsLink();
            $link->event_id = $event_id;
            $link->tags_id = $tagsId;
            $link->save();
        }
    }

    public function deleteEvent($event_id)
    {
        $data_event = Event::findOrFail($event_id);
        $data_event->delete();
    }

    public function trashEvent($event_id)
    {
        $event = Event::findOrFail($event_id);
        $event->update([
            'event_status' => 'Trash',
        ]);
    }

    public function showArticleEvent($event_link)
    {
        $data_event=Event::
        where('event_link', '=', $event_link)
        ->get();

        return [
            'data_event' => $data_event,
        ];
    }
}
