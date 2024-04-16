import { buildModule } from "@nomicfoundation/hardhat-ignition/modules";

export default buildModule("Shop", (m) => {
  const apollo = m.contract("Shop");

  m.call(apollo, "balanceOf", []);

  return { apollo };
});