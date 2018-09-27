<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContenuFormation
 *
 * @ORM\Table(name="contenu_formation", indexes={@ORM\Index(name="fk_contenu_formation_fonmation1_idx", columns={"idformation"}), @ORM\Index(name="fk_contenu_formation_contenu_img1_idx", columns={"idimage"}), @ORM\Index(name="fk_contenu_formation_contenu_video1_idx", columns={"idvideo"})})
 * @ORM\Entity
 */
class ContenuFormation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcontenu_formation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcontenuFormation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contenu_title", type="string", length=45, nullable=true)
     */
    private $contenuTitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contenu_text", type="string", length=255, nullable=true)
     */
    private $contenuText;

    /**
     * @var \ContenuImg
     *
     * @ORM\ManyToOne(targetEntity="ContenuImg")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idimage", referencedColumnName="idcontenu_img")
     * })
     */
    private $idimage;

    /**
     * @var \ContenuVideo
     *
     * @ORM\ManyToOne(targetEntity="ContenuVideo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idvideo", referencedColumnName="idvideo")
     * })
     */
    private $idvideo;

    /**
     * @var \Formation
     *
     * @ORM\ManyToOne(targetEntity="Formation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idformation", referencedColumnName="idformation")
     * })
     */
    private $idformation;


}
