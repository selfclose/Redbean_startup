## **My startup redbean**

Use autoload (PSR-0) and [Redbean](http://www.redbeanphp.com/) for ORM

It's not fully MVC, but it can make things easier, because We do same thing all the time.

I'm serious about file size, so I avoid large ORM or framework that's have a bunch of unused code.

* In 'include.php' there is config.
* Each file will tell how it's work.
* Example model (src/RB/Model) that's extends from Controller.

### Ability
* CRUD make more simple through model
* ReadAll
* Count
* json_encode
* Paginate (php / jQuery with ajax)

_arnanthachai@intbizth.com_

#### Simple Model

```php
<?php
/**
 * Class Book
 * @property int id
 * @property string name
 * @property int price
 */
class Book extends RedBeanController
{
    function __construct($tableId = 0)
    {
        parent::__construct($tableId);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->dataModel->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->dataModel->name = $name;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->dataModel->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->dataModel->price = $price;
    }
}
```
It's will automatic create table's name by class name

Or you can manually tell table's name by add

```php
    protected $table = 'book';
```


**Now, You can insert update delete count paginate without concern about table**

###### Insert
```php
<?php
$book = new \RB\Model\Book();
$book->setName('Harry Potter');
$book->setPrice(1200);
$book->insertAction();
```

###### Update (Same as insert just add id on construct)
```php
<?php
$idToUpdate = 1;
$book = new \RB\Model\Book($idToUpdate);
if ($book->readAction()) {
    $book->setName('Harry potter and the cursed child');
    $book->setPrice(1400);

    $book->updateAction();
} else {
    echo "Can't Update(or no id): ".$idToUpdate;
}
```

###### Delete
```php
<?php
$idToDelete = 1;
$book = new \RB\Model\Book($idToDelete);
if ($book->deleteAction()) {
    echo "ID: ".$idToDelete." is Deleted!";
} else {
    echo "Can't Delete(or no id): ".$idToDelete;
}
```

###### Display (Where id style)
```php
<?php
$idToRead = 2;
$book = new \RB\Model\Book($idToRead);
if ($book->readAction()) {
?>
    <p>ID: <?=$book->getId()?></p>
    <p>Name: <?=$book->getName()?></p>
    <p>price: <?=$book->getPrice()?></p>
<?php
} else {
    echo 'Can\'t read ID: '.$idToRead;
}

```

Another thing in project.

###Relation Keyword (I May wrong)
* Example Dummy is table name

one-to-many: "own"

```php
//Library
$this->dataModel->ownBook = \R::load('book', 1);
```

many-to-one: 

```php
//Library
$this->dataModel->book_id = 2;
```

many-to-many: "shared"

```php
//Book
$this->dataModel->sharedAuthor = \R::load('author', 1);
```
