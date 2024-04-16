import { ethers, network } from "hardhat";
import path from "path";
import { artifacts } from "hardhat";


async function main(): Promise<void> {
  if (network.name === "hardhat") {
    console.warn(
      "You are trying to deploy a contract to the Hardhat Network, which" +
        "gets automatically created and destroyed every time. Use the Hardhat" +
        " option '--network localhost'"
    );
  }

  const [deployer] = await ethers.getSigners();
  console.log(
    "Deploying the contracts with the account:",
    await deployer.getAddress()
  );

  console.log("Account balance:", (await ethers.provider.getBalance(deployer.address)).toString());

  const Token = await ethers.getContractFactory("Shop");
  const token = await Token.deploy();
  await token.waitForDeployment();
  const token_address = await token.getAddress();
  console.log("Token address:", token_address);

  saveFrontendFiles(token_address);
}

function saveFrontendFiles(token: any): void {
  const fs = require("fs");
  const contractsDir = path.join(__dirname, "..", "frontend", "src", "contracts");

  if (!fs.existsSync(contractsDir)) {
    fs.mkdirSync(contractsDir);
  }

  fs.writeFileSync(
    path.join(contractsDir, "contract-address.json"),
    JSON.stringify({ Token: token }, undefined, 2)
  );

  const TokenArtifact = artifacts.readArtifactSync("Shop");

  fs.writeFileSync(
    path.join(contractsDir, "Token.json"),
    JSON.stringify(TokenArtifact, null, 2)
  );
}

main()
  .then(() => process.exit(0))
  .catch((error) => {
    console.error(error);
    process.exit(1);
  });