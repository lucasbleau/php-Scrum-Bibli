<?php
namespace App\UserStories\RendreDisponibleMedia;

use Symfony\Component\Validator\Constraints as Assert;

class RendreDisponibleMediaRequete{
    #[Assert\NotBlank(
        message: "Veuillez renseignez le numéro du média à rendre disponible"
    )]
    public ?int $id;

    /**
     * @param int|null $id
     */
    public function __construct(?int $id){
        $this->id = $id;
    }
}