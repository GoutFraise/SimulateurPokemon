<?php

class PokemonManager
{
    private $poke1;
    private $poke2;
    private $nomAttack1;

    private $nomAttack2;
    public $first_to_att;

    public function __construct($poke1, $poke2,$nomAttack1,$nomAttack2)
    {
        $this->poke1 = $poke1;
        $this->poke2 = $poke2;
        $this->nomAttack1 = $nomAttack1;
        $this->nomAttack2 = $nomAttack2;
    }
    public function changeAttack($pokemon,$attack){
        if($pokemon==$this->poke1){
            $this->nomAttack1=$attack;
        }
        else{
            $this->nomAttack2=$attack;
        }

    }
    public function p_cap()
    {
        if ($this->poke1->listAttack[$this->nomAttack1][2] > $this->poke2->listAttack[$this->nomAttack2][2]) {
            $this->first_to_att = $this->poke1;
            echo "Pokemon 1 attaque en premier (capacité) <br>";
        } else if ($this->poke1->listAttack[$this->nomAttack1][2] < $this->poke2->listAttack[$this->nomAttack2][2]) {
            $this->first_to_att =$this->poke2;
            echo "Pokemon 2 attaque en premier (capacité)<br>";
        } else {
            return $this->v_pok();
        }
    }

    public function v_pok()
    {
        if ($this->poke1->speed > $this->poke2->speed) {
            $this->first_to_att = $this->poke1;
            echo "Pokemon 1 attaque en premier (vitesse)<br>";
        } else if ($this->poke1->speed > $this->poke2->speed) {
            $this->first_to_att = $this->poke2;
            echo "Pokemon 2 attaque en premier (vitesse)<br>";
        } else {
            $choices = [$this->poke1, $this->poke2];
            $p = $choices[array_rand($choices)];
            $this->first_to_att=$p;
            echo "Les deux Pokémon ont le même niveau de capacité et la même vitesse, le choix se fera aléatoirement :". $p->name ." attaque en premier.<br>";
        }
    }
    public function attackOrder(){
        if($this->first_to_att==$this->poke1){
            if($this->poke1->getHp()<=0){
                echo $this->poke1->name." est mort impossible pour lui d'attaquer <br>";
            }
            else{
                if($this->poke2->getHp()<=0){
                    echo $this->poke2->name." est mort impossible de l'attaquer <br>";
                }
                else{
                    $this->poke1->Attack($this->poke2,$this->nomAttack1);
                    echo $this->poke2->name." a ".$this->poke2->getHp()." hp <br>";
                    if($this->poke2->getHp()<=0){
                        echo $this->poke2->name." est mort impossible pour lui d'attaquer <br>";
                    }
                    else{
                        $this->poke2->Attack($this->poke1,$this->nomAttack2);
                        echo $this->poke1->name." a ".$this->poke1->getHp()." hp <br>";
                        if($this->poke1->getHp()<=0){
                            echo $this->poke1->name." est mort<br>";
                        }
                    }
                }
            }
        }
        else{
            if($this->poke2->getHp()<=0){
                echo $this->poke2->name." est mort impossible pour lui d'attaquer <br>";
            }
            else{
                if($this->poke1->getHp()<=0){
                    echo $this->poke1->name." est mort impossible de l'attaquer <br>";
                }
                else{
                    $this->poke2->Attack($this->poke1,$this->nomAttack2);
                    echo $this->poke1->name." a ".$this->poke1->getHp()." hp <br>";
                    if($this->poke1->getHp()<=0){
                        echo $this->poke1->name." est mort impossible pour lui d'attaquer <br>";
                    }
                    else{
                        $this->poke1->Attack($this->poke2,$this->nomAttack1);
                        echo $this->poke2->name." a ".$this->poke2->getHp()." hp <br>";
                        if($this->poke2->getHp()<=0){
                            echo $this->poke2->name." est mort<br>";
                        }
                    }
                }
            }
        }
    }
}
