<?php

require_once "PokemonManager.php";
require_once "ClassW.php";
require_once "stackzone.php";
Class Pokemon{
    private $hp;
    private $att;
    private $def;
    private $attspe;
    private $defspe;
    public $speed;

    public $name;
    private $type;
    private $niveau;
    private $numero_pokedex;
    public $listAttack=[];
    public function __construct($name,$hp,$att,$def,$attspe,$defspe,$speed,$nom,$type,$niveau,$numero_pokedex){
        $this->name=$name;
        $this->hp=$hp;
        $this->att=$att;
        $this->def=$def;
        $this->attspe=$attspe;
        $this->defspe=$defspe;
        $this->speed=$speed;
        $this->type=$type;
        $this->niveau=$niveau;
        $this->numero_pokedex=$numero_pokedex;

    }
    public function Attack($poke_enemi,$nomAtt){
        $degat=((2*$this->niveau/2+2)*$this->listAttack[$nomAtt][0]*($this->attspe/$poke_enemi->defspe))/50+2;
        $poke_enemi->hp=$poke_enemi->hp-$degat;
    } 
    public function addAttack($nomAtt,$degat,$type,$speed){
        $this->listAttack["$nomAtt"]=[$degat,$type,$speed];
    }
    public function addLevel(){
        $this->niveau+=1;
        echo $this->niveau;
    }
    public function se_presenter() {
        echo 'Je suis le Pokémon ' . $this->name . ' de type ' . $this->type . ' avec une vitesse de ' . $this->speed . ' et mon numéro Pokédex est ' . $this->numero_pokedex . '.';
    }
    public function getHp(){
        return $this->hp;
    }
    public function usePotion($inventaire,$nompotion){
        for($i=0;$i<count($inventaire->categories["medicines"]);$i++){
            if(isset($inventaire->categories["medicines"]['items'][$i])){
                if($inventaire->categories["medicines"]['items'][$i]->_name==$nompotion){
                    $this->hp=$this->hp+$inventaire->categories["medicines"]['items'][$i]->value;
                    array_splice($inventaire->categories["medicines"]['items'], $i,1 );
                    break;
                }
            }
            if($i==count($inventaire->categories["medicines"])-1){
                echo "plus de potion ".$nompotion."<br>";
            }
        }  
    }
    public function capture($inventaire,$nomPokeball){
        for($i=0;$i<count($inventaire->categories["pokeballs"]);$i++){
            if($inventaire->categories["pokeballs"]['items'][$i]->_name==$nomPokeball){
                
            }
        }    
    }
    public function getNiveau(){
        return $this->niveau;
    }
    public function getName(){
        return $this->name;
    }
}

/*setup pokemon */
$pikachu = new Pokemon("pikachu",35, 55, 40,50,50,90,"Pikachu","Électrique",1,25);
$ouisticram = new Pokemon("ouisticram", 44, 58, 44, 58, 44, 61, "Ouisticram", "Feu", 1, 3);
$ouisticram->addAttack("charge",50, "normal",50);
$pikachu->addAttack("eclerc",60, "electrique",40);
$pikachu->addAttack("viveAttack",60, "electrique",60);

/* creation equipe*/
$equipe1 = new ClassW();
$equipe2 = new ClassW();
$equipe1->c("legendary",$pikachu);
$equipe2->c("legendary",$ouisticram);

/* inventaire */
$stackzone1 = new Stackzone();
$stackzone1->addObj('pokeballs', new StackObj(1, 'Poké Ball', 'pokeball', 'Une Poké Ball standard.', 'Attrape un Pokémon.', 'poke_ball.png',0, true, false, true, false, false));
$stackzone1->addObj('pokeballs', new StackObj(2, 'Master Ball', 'pokeball', 'Ne rate jamais sa cible.', 'Attrape automatiquement un Pokémon.', 'master_ball.png',0, true, false, true, false, false));
$stackzone1->addObj('pokeballs', new StackObj(3, 'Super Ball', 'pokeball', 'Meilleure qu\'une Poké Ball.', 'Taux de capture amélioré.', 'super_ball.png',0, true, false, true, false, false));
$stackzone1->addObj('pokeballs', new StackObj(4, 'Hyper Ball', 'pokeball', 'Encore meilleure.', 'Capture encore plus efficace.', 'ultra_ball.png',0, true, false, true, false, false));
$stackzone1->addObj('medicines', new StackObj(5, 'Potion', 'medicine', 'Restaure 20 PV.', 'Soigne légèrement un Pokémon.', 'potion.png',20 , true, true, true, false, false));
$stackzone1->addObj('medicines', new StackObj(6, 'bigPotion', 'medicine', 'Restaure 50 PV.', 'Soigne légèrement un Pokémon.', 'potion.png',50, true, true, true, false, false));

/*fight pokemon */
$manager = new PokemonManager($equipe2->equipe[0], $equipe1->equipe[0],"charge","eclerc");
$manager->p_cap();
$manager->attackOrder();
$manager->changeAttack($equipe1->equipe[0],"viveAttack");
$manager->p_cap();
$manager->attackOrder();
$manager->attackOrder();
$manager->attackOrder();
$manager->attackOrder();
$manager->attackOrder();
var_dump($stackzone1->categories["medicines"]);
$pikachu->usePotion($stackzone1,"Potion");
echo $pikachu->getHp()."<br>";
$pikachu->usePotion($stackzone1,"Potion");
echo $pikachu->getHp()."<br>";
$pikachu->usePotion($stackzone1,"bigPotion");
echo $pikachu->getHp()."<br>";
$pikachu->usePotion($stackzone1,"bigPotion");
echo $pikachu->getHp()."<br>";
$manager->attackOrder();
$manager->attackOrder();
var_dump($stackzone1->categories["medicines"]);






