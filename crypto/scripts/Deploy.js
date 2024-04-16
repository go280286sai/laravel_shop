const {hre, network, ethers, artifacts} = require('hardhat');
const fs = require('fs');
const path = require('path');
const nameContract = 'Shop'
async function main() {
  if (network.name === "hardhat") {
    console.warn(
      "You are trying to deploy a contract to the Hardhat Network, which" +
        "gets automatically created and destroyed every time. Use the Hardhat" +
        " option '--network localhost'"
    );
  }

  const [deployer] = await ethers.getSigners()

  console.log("Deploying with", await deployer.getAddress())

  const tokenContractFactory = await ethers.getContractFactory(nameContract, deployer)
  const getTokenContractFactory = await tokenContractFactory.deploy()
  
  await getTokenContractFactory.waitForDeployment()
  const tokenContract = await getTokenContractFactory.getAddress();

  console.log("Token address:", tokenContract)
  

  saveFrontendFiles(tokenContract)
}

function saveFrontendFiles(token) {
  const contractsDir = path.join(__dirname, "..", "frontend", "src", "contracts");

  if (!fs.existsSync(contractsDir)) {
    fs.mkdirSync(contractsDir);
  }

  fs.writeFileSync(
    path.join(contractsDir, "contract-address.json"),
    JSON.stringify({ Token: token }, undefined, 2)
  );

  const TokenArtifact = artifacts.readArtifactSync(nameContract);

  fs.writeFileSync(
    path.join(contractsDir, "Token.json"),
    JSON.stringify(TokenArtifact, null, 2)
  );
}

main()
  .then(() => process.exit(0))
  .catch((error) => {
    console.error(error)
    process.exit(1)
  })