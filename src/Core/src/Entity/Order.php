<?php
declare(strict_types=1);

namespace Core\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="_order")
 */
class Order extends AbstractRootEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected int $id;
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected \DateTime $createdAt;
    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected ?\DateTime $updatedAt = null;
    /**
     * @ORM\Column(name="mark_datetime", type="datetime", nullable=true)
     */
    protected ?\DateTime $markDatetime = null;
    /**
     * @ORM\Column(name="country_iso", type="string")
     */
    protected string $countryIso = 'RU';
    /**
     * @ORM\Column(name="first_name", type="string")
     */
    protected string $firstName;
    /**
     * @ORM\Column(name="last_name", type="string")
     */
    protected string $lastName;
    /**
     * @ORM\Column(name="total_price", type="float")
     */
    protected float $totalPrice;
    /**
     * @ORM\Column(name="price_with_discount", type="float")
     */
    protected float $priceWithDiscount;
    /**
     * @ORM\Column(name="personal_discount", type="float")
     */
    protected float $personalDiscount = 0;
    /**
     * @ORM\Column(name="order_type", type="string")
     */
    protected string $orderType;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected ?string $email = null;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Order
     */
    public function setId(int $id): Order
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Order
     */
    public function setCreatedAt(\DateTime $createdAt): Order
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime|null $updatedAt
     * @return Order
     */
    public function setUpdatedAt(?\DateTime $updatedAt): Order
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getMarkDatetime(): ?\DateTime
    {
        return $this->markDatetime;
    }

    /**
     * @param \DateTime|null $markDatetime
     * @return Order
     */
    public function setMarkDatetime(?\DateTime $markDatetime): Order
    {
        $this->markDatetime = $markDatetime;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryIso(): string
    {
        return $this->countryIso;
    }

    /**
     * @param string $countryIso
     * @return Order
     */
    public function setCountryIso(string $countryIso): Order
    {
        $this->countryIso = $countryIso;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Order
     */
    public function setFirstName(string $firstName): Order
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Order
     */
    public function setLastName(string $lastName): Order
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     * @return Order
     */
    public function setTotalPrice(float $totalPrice): Order
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceWithDiscount(): float
    {
        return $this->priceWithDiscount;
    }

    /**
     * @param float $priceWithDiscount
     * @return Order
     */
    public function setPriceWithDiscount(float $priceWithDiscount): Order
    {
        $this->priceWithDiscount = $priceWithDiscount;
        return $this;
    }

    /**
     * @return float|int
     */
    public function getPersonalDiscount()
    {
        return $this->personalDiscount;
    }

    /**
     * @param float|int $personalDiscount
     * @return Order
     */
    public function setPersonalDiscount($personalDiscount)
    {
        $this->personalDiscount = $personalDiscount;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderType(): string
    {
        return $this->orderType;
    }

    /**
     * @param string $orderType
     * @return Order
     */
    public function setOrderType(string $orderType): Order
    {
        $this->orderType = $orderType;
        return $this;
    }
}