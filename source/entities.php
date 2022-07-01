<?php
class Book
{
    public $name;
    public $author;
    public $publisher;
    public $genre;
    public $isbn;
    public $amount;
    public $available;
    public $queue;
    public $votes;

    function create_book($name, $author, $publisher, $genre, $isbn, $amount, $available)
    {
        $this->name = $name;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->genre = $genre;
        $this->isbn = $isbn;
        $this->amount = $amount;
        $this->available = $available;
        $this->queue = 0;
        $this->votes = 0;
    }

    function get_book_info()
    {
        return [$this->name, $this->author, $this->publisher, $this->genre, $this->isbn, $this->amount, $this->available];
    }

    function change_book_count($amount)
    {
        $this->amount = $this->amount + $amount;
        //negative amount = amount of books waiting in queue
        if($this->amount < 0)
        {
            $this->queue = -$this->amount;
        }
        //clear queue if all reservations have books available
        else
        {
            $this->queue = 0;
        }
    }

    //when the book title previously wasn't present in the library and you just added it
    function make_available()
    {
        $this->available = true;
    }

    function vote()
    {
        $this->votes = $this->votes + 1;
    }
}

class reservation
{
    public $name;
    public $user_id;
    public $pending;
    public $return_date;
    public $fine;

    function create_reservation($name, $user_id)
    {
        $this->name = $name;
        $this->user_id = $user_id;
        $this->pending = $true;
        $this->return_date = null;
        $this->fine = 0;
    }

    function get_reservation_data()
    {
        return [$this->name, $this->user_id, $this->pending, $this->return_date, $this->fine];
    }

    function confirm_reservation($return_date)
    {
        $this->pending = false;
        $this->return_date = $return_date;
    }

    function set_fine($fine)
    {
        $this->fine = $fine;
    }
}

class user
{
    public $id;
    private $password;
    public $role;

    function create_user($id, $password, $role)
    {
        $this->id = $id;
        $this->password = $password;
        $this->role = $role;
    }

    function get_user_data()
    {
        return[$this->id, $this->role];
    }

    function change_role($role)
    {
        $this->role = $role;
    }

    function authenticate($id, $password)
    {
        if($id == $this->id && $password == $this->password)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

class order
{
    public $book_name;
    public $publisher;
    public $amount;
    public $ordered_by;

    function place_order($book_name, $publisher, $amount, $ordered_by)
    {
        $this->book_name = $book_name;
        $this->publisher = $publisher;
        $this->amount = $amount;
        $this->ordered_by = $ordered_by;
    }

    function get_order_data()
    {
        return [$this->book_name, $this->publisher, $this->amount, $this->ordered_by];
    }
}

class library
{
    public $name;
    public $address;
    public $opening_hours;

    function add_library($name, $address, $opening_hours)
    {
        $this->name = $name;
        $this->opening_hours = $opening_hours;
        $this->address = $address;
    }

    function get_library_data()
    {
        return [$this->name, $this->address, $this->opening_hours];
    }

    function change_opening_hours($opening_hours)
    {
        $this->opening_hours = $opening_hours;
    }
}

?> 