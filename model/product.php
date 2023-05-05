<!--Name: Jato Ulrich Guiffo Kengne 
	Date: April 08, 2023 
	Section: CST 8285 section 303
	Assignment: 02 
	File: product.php
	Assignment objective: Use HTML, CSS, JavaScript, PHP and 
	MySQL to buils a web aplication to perform CRUD operation
-->
<?php
class Product
{

	private $id;
	private $name;
	private $category;
	private $price;
	private $image;
	private $exp_date;

	function __construct($id, $name, $category, $price, $image, $exp_date)
	{
		$this->setId($id);
		$this->setName($name);
		$this->setCategory($category);
		$this->setPrice($price);
		$this->setImage($image);
		$this->setDate($exp_date);
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getCategory()
	{
		return $this->category;
	}

	public function setCategory($category)
	{
		$this->category = $category;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function setPrice($price)
	{
		$this->price = $price;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setImage($image)
	{
		$this->image = $image;
	}

	public function getImage()
	{
		return $this->image;
	}

	public function setDate($exp_date)
	{
		$this->exp_date = $exp_date;
	}

	public function getDate()
	{
		return $this->exp_date;
	}

}
?>