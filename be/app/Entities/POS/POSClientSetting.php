<?php
namespace App\Entities\POS;

use App\Base\EntityBase;
use \App\Base\TransformTrait;

/**
 * Class POSClientSetting
 * @package App\Entities\POS
 * @author Mark Wickline 2022-12-31
 */
class POSClientSetting extends EntityBase
{
    use TransformTrait;

    public $checkoutGridItemDisplayType;

    private static $checkoutGridItemDisplayTypeOptions = [
        'picture' => "Display products with an image"
    ];

    public function __construct($attributes = [])
    {
        $this->setDefaults();
        parent::__construct($attributes);
    }

    /**
     * Set default values
     * 
     * @return void
     */
    private function setDefaults()
    {
        $this->checkoutGridItemDisplayType = 
            $this->t_firstCodeDesc(self::$checkoutGridItemDisplayTypeOptions);
    }

    /**
     * Get the options for the checkout grid item display type.
     * 
     * @return array
     */
    public static function getCheckoutGridItemDisplayOptions()
    {
        return self::$checkoutGridItemDisplayTypeOptions;
    }
}
