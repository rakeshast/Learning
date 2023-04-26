<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Random;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Authors extends Component
{

    use WithPagination;
    public $name, $email, $username, $author_type, $direct_publisher;
    public $search;
    public $perPage = 4;
    public $selected_author_id;
    public $blocked = 0;

    protected $listeners = [
        'resetForm',
        'deleteAuthorAction'
    ];

    public function mount()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->name = $this->email = $this->username = $this->author_type = $this->direct_publisher = null;
        $this->resetErrorBag();
    }

    public function addAuthor()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|min:6|max:20',
            'author_type' => 'required',
            'direct_publisher' => 'required',
        ], [
            'author_type.required' => "Choose author type",
            'direct_publisher.required' => 'Specify author publication access',
        ]);

        if ($this->isOnline()) {

            $default_password = Random::generate(8);

            $author = new User();
            $author->name = $this->name;
            $author->email = $this->email;
            $author->username = $this->username;
            $author->type = $this->author_type;
            $author->password = Hash::make($default_password);
            $author->direct_publish = $this->direct_publisher;
            $saved = $author->save();

            $data = array(
                'name' => $this->name,
                'email' => $this->email,
                'username' => $this->username,
                'password' => $default_password,
                'url' => route('author.profile'),
            );

            $author_email = $this->email;
            $author_name = $this->name;

            if ($saved) {

                Mail::send('new-author-email-template', $data, function ($message) use ($author_email, $author_name) {
                    $message->from('noreply@larablog.com', 'Larablog');
                    $message->to($author_email, $author_name)
                        ->subject('Account Creation');
                });

                // $mail_body = view('new-author-email-template', $data)->render();
        
                // $mailConfig = array(
                //     'mail_from_email' => env("EMAIL_FROM_ADDRESS"),
                //     'mail_from_name' => env("EMAIL_FROM_NAME"),
                //     'mail_recipient_email' => $author->email,
                //     'mail_recipient_name' => $author->name,
                //     'mail_subject' => "Account Creation",
                //     'mail_body' => $mail_body,
                // );

                // sendMail($mailConfig);

                $this->showToastr('New author has been added to blog', 'success');
                $this->name = $this->username = $this->email = $this->author_type = $this->direct_publisher = null;
                $this->dispatchBrowserEvent('hide_add_author_modal');


            } else {
                $this->showToastr('Something went wrong', 'error');
            }
        } else {
            $this->showToastr('Your are offline, check your connection and submit form again later', 'error');
        }
    }

    public function editAuthor($author)
    {
        // dd("Edit author", $author);

        $this->selected_author_id = $author['id'];
        $this->name = $author['name'];
        $this->email = $author['email'];
        $this->username = $author['username'];
        $this->author_type = $author['type'];
        $this->direct_publisher = $author['direct_publish'];
        $this->blocked = $author['blocked'];

        $this->dispatchBrowserEvent('showEditAuthorModal');
    }

    public function updateAuthor()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->selected_author_id,
            'username' => 'required|min:6|max:20|unique:users,username,' . $this->selected_author_id,
        ]);
        if ($this->selected_author_id) {
            $author = User::find($this->selected_author_id);
            $author->update([
                'name' => $this->name,
                'email' => $this->email,
                'username' => $this->username,
                'type' => $this->author_type,
                'blocked' => $this->blocked,
                'direct_publish' => $this->direct_publisher,
            ]);
        }
        $this->showToastr('Author detail has been successfully updated', 'success');
        $this->dispatchBrowserEvent('hide_edit_author_modal');
    }

    public function deleteAuthor($author)
    {
        // dd("Author has been deleted successfully", $author);
        $this->dispatchBrowserEvent('deleteAuthor', [
            'title' => "Are you sure?",
            'html' => "You want to delete this author: <br><br>" . $author['name'] . "<br>",
            'id' => $author['id'],
        ]);
    }

    public function deleteAuthorAction($id)
    {
        // dd("Yes deleted", $id);
        $author = User::find($id);
        $path = 'back/dist/img/authors/';
        $author_picture = $author->getAttributes()['picture'];
        $picture_fullpath = $path . $author_picture;
        if ($author_picture != null || File::exists(public_path($picture_fullpath))) {
            File::delete(public_path($picture_fullpath));
        }
        $author->delete();
        $this->showToastr('Author has been deleted successfully', 'info');
    }

    public function isOnline($site = "https://www.youtube.com/")
    {
        if (@fopen($site, 'r')) {
            return true;
        } else {
            return false;
        }
    }

    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function render()
    {
        return view('livewire.authors', [
            'authors' => User::search(trim($this->search))
                ->where('id', '!=', auth()->id())->paginate($this->perPage),
        ]);
    }
}
