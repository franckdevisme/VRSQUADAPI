<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table(name="formation", indexes={@ORM\Index(name="fk_formation_Entreprise1_idx", columns={"idEntreprise"}), @ORM\Index(name="fk_formation_categorie1_idx", columns={"idcategorie"})})
 * @ORM\Entity
 */
class Formation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idformation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idformation;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_formation", type="string", length=255, nullable=false)
     */
    private $nomFormation;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_de_publication", type="date", nullable=false)
     */
    private $dateDePublication;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_de_lessons", type="integer", nullable=false)
     */
    private $nombreDeLessons;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="text", length=0, nullable=false)
     */
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=45, nullable=false)
     */
    private $version;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_update", type="date", nullable=false)
     */
    private $dateUpdate;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_de_vue", type="integer", nullable=false)
     */
    private $nombreDeVue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="devices_compatible", type="text", length=0, nullable=true)
     */
    private $devicesCompatible;

    /**
     * @var bool
     *
     * @ORM\Column(name="display_pour_user", type="boolean", nullable=false)
     */
    private $displayPourUser;

    /**
     * @var bool
     *
     * @ORM\Column(name="isvalide", type="boolean", nullable=false)
     */
    private $isvalide;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idcategorie", referencedColumnName="idcategorie")
     * })
     */
    private $idcategorie;

    /**
     * @var \Entreprise
     *
     * @ORM\ManyToOne(targetEntity="Entreprise")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEntreprise", referencedColumnName="idEntreprise")
     * })
     */
    private $identreprise;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ContenuImg", inversedBy="formation")
     * @ORM\JoinTable(name="formation_has_contenu_img",
     *   joinColumns={
     *     @ORM\JoinColumn(name="formation", referencedColumnName="idformation")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="contenu_img", referencedColumnName="idcontenu_img")
     *   }
     * )
     */
    private $contenuImg;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ContenuVideo", inversedBy="formation")
     * @ORM\JoinTable(name="formation_has_contenu_video",
     *   joinColumns={
     *     @ORM\JoinColumn(name="formation", referencedColumnName="idformation")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="contenuvideo", referencedColumnName="idvideo")
     *   }
     * )
     */
    private $contenuvideo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Contenutest", inversedBy="formation")
     * @ORM\JoinTable(name="formation_has_contenutest",
     *   joinColumns={
     *     @ORM\JoinColumn(name="formation", referencedColumnName="idformation")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="contenutest", referencedColumnName="idtest")
     *   }
     * )
     */
    private $contenutest;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Contenutext", inversedBy="formation")
     * @ORM\JoinTable(name="formation_has_contenutext",
     *   joinColumns={
     *     @ORM\JoinColumn(name="formation", referencedColumnName="idformation")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="contenutext", referencedColumnName="idContenutext")
     *   }
     * )
     */
    private $contenutext;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="idformation")
     */
    private $id;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contenuImg = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contenuvideo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contenutest = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contenutext = new \Doctrine\Common\Collections\ArrayCollection();
        $this->id = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
