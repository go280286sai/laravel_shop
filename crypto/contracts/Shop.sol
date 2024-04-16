// SPDX-License-Identifier: UNLICENSED
pragma solidity ^0.8.0;

contract Shop {
    address payable private owner;
    struct Payment {
        int256 id;
        address from;
        uint256 total;
        int256 time;
    }
    mapping(int256 => Payment) private Payments;

    constructor() {
        owner = payable(msg.sender);
    }

    event ToPay(int256 id, address from, uint256 total, int256 time);

    event ToSend(uint256 total, string target, int256 time);

    modifier Is_owner() {
        require(owner != msg.sender, "Not owner");
        _;
    }

    function pay(int256 id) external payable {
        address from_ = msg.sender;
        uint256 total_ = uint256(msg.value);
        int256 time_ = int256(block.timestamp);
        emit ToPay(int256(id), from_, total_, time_);
        Payment memory newpay = Payment(int256(id), from_, total_, time_);
        Payments[id] = newpay;
    }

    function to_send(uint256 value) public Is_owner {
        emit ToSend(value, "sent many", int256(block.timestamp));
        owner.transfer(value);
    }

    function send_all() public Is_owner {
        uint256 value = uint256(address(this).balance);
        emit ToSend(value, "sent many", int256(block.timestamp));
        owner.transfer(value);
    }

    function transaction(int256 id) public view returns (Payment memory) {
        return Payments[id];
    }

    function balanceOf() public view returns (uint256) {
        return uint256(address(this).balance);
    }

    function backMoney(int256 id) public returns (string memory) {
        require(owner==msg.sender, "forrbiten");
        Payment memory payment = transaction(id);
        uint256 balance_ = balanceOf();
        require(payment.total < balance_, "Not enough money");
        address payable user = payable(payment.from);
        delete Payments[id];
        user.transfer(payment.total);
        return "ok";
    }
  
}
