<?php
/**
 * Created by PhpStorm.
 * User: aziz
 * Date: 19/02/2018
 * Time: 11:32
 */

namespace CupCakesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Money\Currency;
use Money\Money;

/**
 * TestMoney
 * @ORM\Table("test_money")
 * @ORM\Entity
 */
class TestMoney
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="price_amount", type="integer")
     */
    private $priceAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="price_currency", type="string", length=64)
     */
    private $priceCurrency;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * get Money
     *
     * @return Money
     */
    public function getPrice()
    {
        if (!$this->priceCurrency) {
            return null;
        }
        if (!$this->priceAmount) {
            return new Money(0, new Currency($this->priceCurrency));
        }
        return new Money($this->priceAmount, new Currency($this->priceCurrency));
    }

    /**
     * Set price
     *
     * @param Money $price
     * @return TestMoney
     */
    public function setPrice(Money $price)
    {
        $this->priceAmount = $price->getAmount();
        $this->priceCurrency = $price->getCurrency()->getCode();

        return $this;
    }

    /**
     * Set priceAmount.
     *
     * @param int $priceAmount
     *
     * @return TestMoney
     */
    public function setPriceAmount($priceAmount)
    {
        $this->priceAmount = $priceAmount;

        return $this;
    }

    /**
     * Get priceAmount.
     *
     * @return int
     */
    public function getPriceAmount()
    {
        return $this->priceAmount;
    }

    /**
     * Set priceCurrency.
     *
     * @param string $priceCurrency
     *
     * @return TestMoney
     */
    public function setPriceCurrency($priceCurrency)
    {
        $this->priceCurrency = $priceCurrency;

        return $this;
    }

    /**
     * Get priceCurrency.
     *
     * @return string
     */
    public function getPriceCurrency()
    {
        return $this->priceCurrency;
    }
}
