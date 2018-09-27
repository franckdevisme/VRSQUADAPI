<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContenuVideo
 *
 * @ORM\Table(name="contenu_video")
 * @ORM\Entity
 */
class ContenuVideo
{
    /**
     * @var int
     *
     * @ORM\Column(name="idvideo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvideo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="video", type="text", length=0, nullable=true)
     */
    private $video;


}
