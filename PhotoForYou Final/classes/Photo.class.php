<?php
class Photo
{
	// Attributs
	private $_idPhoto;
	private $_nomPhoto;
	private $_taillePixelX;
	private $_taillePixelY;
	private $_poids;
	private $_idUser;
    private $_urlPhoto;
	private $_categorie;
	private $_description;
	

	public function __construct(array $donnees)
	{
		$this->hydrate($donnees);
	}

	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value) {
			$method = 'set'.ucfirst($key);

			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}

	// Getters

	public function getId()
	{
		return $this->_idPhoto;
	}

	public function getNomPhoto()
	{
		return $this->_nomPhoto;
	}

	public function getTaillePixelX()
	{
		return $this->_taillePixelX;
	}

	public function getPoids()
	{
		return $this->_poids;
	}

	public function getTaillePixelY()
	{
		return $this->_taillePixelY;
	}

	public function getCategorie()
	{
		return $this->_categorie;
	}

	public function getIdUser()
	{
		return $this->_idUser;
	}

    public function getUrlPhoto()
	{
		return $this->_urlPhoto;
	}

	public function getDescription()
	{
		return $this->_description;
	}
	// Setters

	public function setId($id)
	{
		$id = (int) $id;
		if ($id > 0)
		{
			$this->_idPhoto = $id;
		}	
	}

	public function setCategorie($categorie)
	{
		if (is_string($categorie))
		{
			$this->_categorie = $categorie;
		}
	}

	public function setNomPhoto($nom)
	{
		if (is_string($nom))
		{
			$this->_nomPhoto = $nom;
		}	
	}

    public function setTaillePixelX($pixel_x)
    {
        $pixel_x = (int) $pixel_x;
        if ($pixel_x > 0) {
            $this->_taillePixelX = $pixel_x;
        }
    }

    public function setTaillePixelY($pixel_y)
    {
        $pixel_y = (int) $pixel_y;
        if ($pixel_y > 0) {
            $this->_taillePixelY = $pixel_y;
        }
    }

    public function setPoids($poids)
    {
        $poids = (int) $poids;
        if ($poids > 0) {
            $this->_poids = $poids;
        }
    }
	public function setIdUser($id)
	{
		$id = (int) $id;
		if ($id > 0)
		{
			$this->_idUser = $id;
		}	
	}
    public function setUrlPhoto($url)
	{
		if (is_string($url))
		{
			$this->_urlPhoto = $url;
		}	
	}

	public function setDescription($des)
	{
		if (is_string($des))
		{
			$this->_description = $des;
		}   
	}



}
?>