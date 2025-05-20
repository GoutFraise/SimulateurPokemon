<?php

/**
 * 
 */
class StackObj
{
  protected int $_id;
  public string $_name;
  protected string $_type;
  protected string $_desc;
  protected string $_effect;
  protected string $_sprites;
  protected bool $_stackable;
  protected bool $_consumable;
  protected bool $_usable;
  protected bool $_heldable;
  protected bool $_held_usable;
  public $value;


  function __construct(int $arg1, string $arg2, string $arg3, string $arg4, string $arg5, string $arg6, $value, bool $arg7, bool $arg8, bool $arg9, bool $arg10, bool $arg11)
  {
    $this->_id = $arg1;
    $this->_name = $arg2;
    $this->_type = $arg3;
    $this->_desc = $arg4;
    $this->_effect = $arg5;
    $this->_sprites = $arg6;
    $this->_stackable = $arg7;
    $this->_consumable = $arg8;
    $this->_usable = $arg9;
    $this->_heldable = $arg10;
    $this->_held_usable = $arg11;
    $this->value=$value;
  }

  public function GetInfo()
  {
    return $this->_name;
  }

  public function Getobj_id()
  {
    return $this->_id;
  }
  public function Getobj_name($id)
  {
    return $this->_name;
  }
  public function Getobj_type($id)
  {
    return $this->_type;
  }
  public function Getobj_desc($id)
  {
    return $this->_desc;
  }
  public function Getobj_effect($id)
  {
    return $this->_effect;
  }
  public function Getobj_sprites($id)
  {
    return $this->_sprites;
  }
  public function Useobj($id) {}
}


class Stackzone
{
  public array $categories = [];

  private array $icons = [
    'items' => 'fas fa-box-open',
    'pokeballs' => 'fas fa-baseball-ball',
    'medicines' => 'fas fa-prescription-bottle-alt',
    'berries' => 'fas fa-apple-alt',
    'mails' => 'fas fa-envelope',
    'tms_hms' => 'fas fa-compact-disc',
    'key_items' => 'fas fa-key',
    'battle_items' => 'fas fa-fist-raised',
    'free_space' => 'fas fa-inbox'
  ];

  public function __construct(array $defaultCategories = [
    'items' => 'Items',
    'pokeballs' => 'Pokéballs',
    'medicines' => 'Medicines',
    'berries' => 'Berries',
    'mails' => 'Mails',
    'tms_hms' => 'TMS / HMS',
    'key_items' => 'Key Items',
    'battle_items' => 'Battle Items',
    'free_space' => 'Free Space'
  ])
  {
    foreach ($defaultCategories as $key => $name) {
      $this->categories[$key] = [
        'name' => $name,
        'items' => []
      ];
    }
  }
  public function addObj(string $categoryKey, StackObj $item): void
  {
    if (!isset($this->categories[$categoryKey])) {
      $this->categories[$categoryKey] = [
        'name' => ucfirst(str_replace('_', ' ', $categoryKey)),
        'items' => []
      ];
    }
    $this->categories[$categoryKey]['items'][] = $item;
  }

  public function getCategories(): void
  {
    echo "<div>";
    echo "<h2>Liste des Catégories Inventaire</h2><hr>";

    foreach ($this->categories as $key => $data) {
      $iconClass = $this->icons[$key];

      echo "<div class='category'>";
      echo "<div class='category-title'><i class='$iconClass'></i> {$data['name']}</div>";

      if (empty($data['items'])) {
        echo "<div class='item'>Aucun objet.</div>";
      } else {
        $i = 1;
        foreach ($data['items'] as $item) {
          echo "<span class='item'>{$i} - {$item->GetInfo()}</span>";
          $i++;
        }
      }
      echo "</div>";
    }
    echo "</div>";
  }
}
?>