<?php

namespace App\Entity;

enum InventoryStatus: string
{
  case INSTOCK = 'INSTOCK';
  case LOWSTOCK = 'LOWSTOCK';
  case OUTOFSTOCK = 'OUTOFSTOCK';

  public static function fromName(string $name)
  {
    return constant("self::$name");
  }
}
