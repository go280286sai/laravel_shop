import {
  time,
  loadFixture,
} from "@nomicfoundation/hardhat-toolbox/network-helpers";
import { anyValue } from "@nomicfoundation/hardhat-chai-matchers/withArgs";
import { expect } from "chai";
import hre from "hardhat";
import { ethers } from "hardhat";
import { int } from "hardhat/internal/core/params/argumentTypes";

describe("Shop testing", function () {
  async function deploy() {
    const [owner, user1, user2, user3] = await ethers.getSigners();
    const factory = await ethers.getContractFactory('Shop');
    // user3 is main address
    const payments = await factory.deploy();
    await payments.waitForDeployment();

    return { owner, user1, user2, user3, payments };
  }
  async function main() {
    const { owner, user1, user2, user3, payments } = await loadFixture(deploy)
    let sum1 = 1000;
    const tx = await payments.connect(user1).pay(1, { value: sum1 });
    await tx.wait();
    let sum2 = 2000;
    const tx2 = await payments.connect(user2).pay(2, { value: sum2 });
    await tx2.wait();
    let sum3 = 3000;
    const tx3 = await payments.connect(user3).pay(3, { value: sum3 });
    await tx3.wait();
    return { owner, user1, user2, user3, payments };
  }
  it("send tokens", async function () {
    const { owner, user1, user2, user3, payments } = await loadFixture(deploy)
    expect(await payments.balanceOf()).to.equal(0);

    // user1 send token
    console.log("user1 send token on 1500 with id = 1");
    let sum1 = 1500;
    let id = 1;
    let money_user = await ethers.provider.getBalance(user1.address);
    console.log("balance before", money_user.toString());
    const tx = await payments.connect(user1).pay(id, { value: sum1 });
    await tx.wait();
    const balance = await payments.balanceOf();
    expect(balance).to.equal(sum1);
    money_user = await ethers.provider.getBalance(user1.address);
    console.log("balance after", money_user.toString());
    expect(money_user).to.changeEtherBalance(1500, -sum1);

    // user2 send token
    console.log("user2 send token on 1000 with id = 2");
    let sum2 = 1000;
    id = 2;
    money_user = await ethers.provider.getBalance(user2.address);
    console.log("balance before", money_user.toString());
    const tx2 = await payments.connect(user2).pay(id, { value: sum2 });
    await tx2.wait();
    const balance2 = await payments.balanceOf();
    expect(balance2).to.equal(sum1 + sum2);
    money_user = await ethers.provider.getBalance(user2.address);
    console.log("balance after", money_user.toString());
    expect(money_user).to.changeEtherBalance(1000, -sum2);

     // user3 send token
     console.log("user3 send token on 1000 with id = 3");
     let sum3 = 1000;
     id = 2;
     money_user = await ethers.provider.getBalance(user3.address);
     console.log("balance before", money_user.toString());
     const tx3 = await payments.connect(user3).pay(id, { value: sum3 });
     await tx3.wait();
     const balance3 = await payments.balanceOf();
     expect(balance3).to.equal(sum1 + sum2 + sum3);
     money_user = await ethers.provider.getBalance(user3.address);
     console.log("balance after", money_user.toString());
     expect(money_user).to.changeEtherBalance(1000, -sum3);
 
    // total balance should be 2500
    let total = await payments.balanceOf();
    expect(total).to.equal(sum1 + sum2+ sum3);
    console.log("total balance", total.toString());
  });
  it("send all", async function () {
    const { owner, user1, user2, user3, payments } = await loadFixture(main)
    expect(await payments.balanceOf()).to.equal(6000);
    // to send 1000 token
    console.log("to send 1000 token");
    let sum = 1000n;
    let total = await payments.balanceOf();
    let owner_balance = await ethers.provider.getBalance(owner.address);
    console.log("balance before", owner_balance.toString());
    const tx3 = await payments.connect(user1).to_send(sum);
    await tx3.wait();
    let total2 = await payments.balanceOf();
    expect(total).to.equal(total2 + sum);
    owner_balance = await ethers.provider.getBalance(owner.address);
    console.log("balance after", owner_balance);
    expect(owner_balance).to.changeEtherBalance(owner_balance, sum);
    console.log("total balance before", total.toString());
    console.log("total balance after", total2.toString());
    
    // send all
    console.log("send all");
    total = await payments.balanceOf();
    console.log("total balance", total.toString());
    owner_balance = await ethers.provider.getBalance(owner.address);
    console.log("user3 balance before", owner_balance.toString());
    const tx4 = await payments.connect(user2).send_all();
    await tx4.wait();
    total = await payments.balanceOf();
    expect(total).to.equal(0);
    owner_balance = await ethers.provider.getBalance(owner.address);
    console.log("balance after", owner_balance.toString());
    expect(owner_balance).to.changeEtherBalance(owner_balance, 0);
    total = await payments.balanceOf();
    console.log("total balance", total.toString());
  });
    it("show", async function () {
    const { owner, user1, user2, user3, payments } = await loadFixture(main)
    // show id 1
    console.log("show id 1");
    let id = 1;
    let show = await payments.transaction(id);
    expect(show[0]).to.eq(id);
    expect(show[1]).to.eq(user1.address);
    expect(show[2]).to.eq(1000);
    console.log("id =", show[0]);
    console.log("address =", show[1]);
    console.log("sum =", show[2]);
    console.log(show[3].toString());

    // show id 2
    console.log("show id 2");
    id = 2;
    show = await payments.transaction(id);
    expect(show[0]).to.eq(id);
    expect(show[1]).to.eq(user2.address);
    expect(show[2]).to.eq(2000);
    console.log("id =", show[0]);
    console.log("address =", show[1]);
    console.log("sum =", show[2]);
    console.log(show[3].toString());

    // show id 3
    console.log("show id 3");
    id = 3;
    show = await payments.transaction(id);
    expect(show[0]).to.eq(id);
    expect(show[1]).to.eq(user3.address);
    expect(show[2]).to.eq(3000);
    console.log("id =", show[0]);
    console.log("address =", show[1]);
    console.log("sum =", show[2]);
    console.log(show[3].toString());
    });
    it("back money", async function () {
    const { owner, user1, user2, user3, payments } = await loadFixture(main)
    // back money
    console.log("back money");
    let balance_ = await payments.balanceOf();
    let user1_mb = await ethers.provider.getBalance(user1.address);
    console.log("user1 balance before", user1_mb.toString());
    let id = 1;
    let show = await payments.transaction(id);
    expect(show[0]).to.eq(id);
    const tx5 = await payments.backMoney(id);
    await tx5.wait();
    console.log("balance before", balance_.toString());
    user1_mb = await ethers.provider.getBalance(user1.address);
    console.log("user1 balance after", user1_mb.toString());
    console.log("balance after", await payments.balanceOf());
    expect(user1_mb).to.changeEtherBalance(user1_mb, 1000);
    
    // back money user2
    balance_ = await payments.balanceOf();
    let user2_mb = await ethers.provider.getBalance(user2.address);
    console.log("user2 balance before", user2_mb.toString());
    id = 2;
    show = await payments.transaction(id);
    expect(show[0]).to.eq(id);
    const tx6 = await payments.backMoney(id);
    await tx6.wait();
    console.log("balance before",balance_.toString());
    user2_mb = await ethers.provider.getBalance(user2.address);
    console.log("user2 balance after", user2_mb.toString());
    console.log("balance after", await payments.balanceOf());
    expect(user2_mb).to.changeEtherBalance(user2_mb, 2000);

    // back money user3
    balance_ = await payments.balanceOf();
    let user3_mb = await ethers.provider.getBalance(user3.address);
    console.log("user3 balance before", user3_mb.toString());
    id = 3;
    show = await payments.transaction(id);
    expect(show[0]).to.eq(id);
    try {
    const tx7 = await payments.connect(user3).backMoney(id);
    await tx7.wait();
    } catch (error) {
      console.log("Failed to send transaction:", error);
          }
    try{
       const tx8 = await payments.backMoney(id);
    await tx8.wait();
    } catch (error) {
            console.log("Failed to send transaction:", error);
          }   
    console.log("balance before",balance_.toString());
    user3_mb = await ethers.provider.getBalance(user3.address);
    console.log("user3 balance after", user3_mb.toString());
    console.log("balance after", await payments.balanceOf());
  })


})

