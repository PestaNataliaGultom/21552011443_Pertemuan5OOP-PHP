<?php

// Definisi kelas Book
class Book {
    private $title;
    private $author;
    private $year;
    private $isBorrowed;

    // Konstruktor untuk inisialisasi buku
    public function __construct($title, $author, $year) {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->isBorrowed = false;
    }
  public function getTitle() {
      return $this->title;
  }
  public function getAuthor() {
          return $this->author;
      }

      public function getYear() {
          return $this->year;
      }

      public function isBorrowed() {
          return $this->isBorrowed;
      }

      public function borrowBook() {
          $this->isBorrowed = true;
      }

      public function returnBook() {
          $this->isBorrowed = false;
      }

    public function getInfo() {
      return $this->title . " by " . $this->auther . " (". $this->year . ")" . ($this->isBorrowed ? " (borrowed)": " (available)") . "\n";
        return "Judul: $this->title | Penulis: $this->author | Tahun Terbit: $this->year";
    }
}

class Library {
    private $books = [];

    public function addBook($book) {
        $this->books[] = $book;
    }

    public function borrowBook($title) {
        foreach ($this->books as $book) {
            if ($book->getTitle() === $title && !$book->isBorrowed()) {
                $book->borrowBook();
                echo "Buku $title berhasil dipinjam.\n";
                return;
            }
        }
        echo "Buku $title tidak tersedia atau sudah dipinjam.\n";
    }

    public function returnBook($title) {
        foreach ($this->books as $book) {
            if ($book->getTitle() === $title && $book->isBorrowed()) {
                $book->returnBook();
                echo "Buku $title berhasil dikembalikan.\n";
                return;
            }
        }
        echo "Buku $title tidak dapat dikembalikan atau tidak tersedia.\n";
    }

    public function printAvailableBooks() {
        if (empty($this->books)) {
            echo "Tidak ada buku yang tersedia.\n";
            return;
        }

        echo "Daftar buku yang tersedia:\n";
        foreach ($this->books as $book) {
            if (!$book->isBorrowed()) {
                echo $book->getTitle() . " oleh " . $book->getAuthor() . " (" . $book->getYear() . ")\n";
            }
        }
    }
}

// Membuat beberapa objek buku
$book1 = new Book("Cantik Itu Luka", "Eka Kurniawan", 2018);
$book2 = new Book("Home Sweet Loan", "Almira Bastari", 2022);
$book3 = new Book("Heartbreak Motel", "Ika Natassa", 2022);

// Membuat objek perpustakaan
$library = new Library();

// Menambahkan buku ke perpustakaan
$library->addBook($book1);
$library->addBook($book2);
$library->addBook($book3);

// Meminjam buku
$library->borrowBook("Cantik Itu Luka");
$library->borrowBook("Home Sweet Loan");
$library->borrowBook("Heartbreak Motel"); // Buku tidak tersedia

// Mengembalikan buku
$library->returnBook("Cantik Itu Luka");
$library->returnBook("The Catcher in the Rye"); // Buku tidak dapat dikembalikan atau tidak tersedia

// Mencetak daftar buku yang tersedia
$library->printAvailableBooks();
