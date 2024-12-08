const loadPokemonOptions = async () => {
  const response = await fetch("https://pokeapi.co/api/v2/pokemon?limit=151");
  const data = await response.json();
  const pokemonList = data.results;

  const select1 = document.getElementById("pokemon1");
  const select2 = document.getElementById("pokemon2");

  for (const pokemon of pokemonList) {
    const details = await fetch(pokemon.url).then((res) => res.json());
    const type = details.types[0]?.type?.name;

    if (["fire", "water", "grass"].includes(type)) {
      const option1 = document.createElement("option");
      const option2 = document.createElement("option");

      option1.value = pokemon.name;
      option1.textContent = capitalize(pokemon.name);

      option2.value = pokemon.name;
      option2.textContent = capitalize(pokemon.name);

      select1.appendChild(option1);
      select2.appendChild(option2);
    }
  }
};

const capitalize = (str) => str.charAt(0).toUpperCase() + str.slice(1);

const updatePokemonForm = async (formId, imageId, pokemonName) => {
  const response = await fetch(
    `https://pokeapi.co/api/v2/pokemon/${pokemonName}`
  );
  const data = await response.json();

  // Couleurs selon le type
  const typeColors = {
    fire: "#f08030",
    water: "#6890f0",
    grass: "#78c850",
  };

  const type = data.types[0]?.type?.name || "normal";
  const form = document.getElementById(formId);
  form.style.backgroundColor = typeColors[type] || "#ccc";

  // Mettre à jour l'image  // l'image se mettait a jour une fois sur deux mais c bonnnnnn ct la connnexion
  const img = document.getElementById(imageId);
  img.src = data.sprites.front_default;
  img.style.display = "block";
};

document.getElementById("pokemon1").addEventListener("change", (e) => {
  updatePokemonForm("form-pokemon1", "image-pokemon1", e.target.value);
});

document.getElementById("pokemon2").addEventListener("change", (e) => {
  updatePokemonForm("form-pokemon2", "image-pokemon2", e.target.value);
});

document.getElementById("start-combat").addEventListener("click", async () => {
  const pokemon1 = document.getElementById("pokemon1").value;
  const pokemon2 = document.getElementById("pokemon2").value;

  const logsContainer = document.getElementById("combat-logs");
  logsContainer.innerHTML = "";

  const response = await fetch("combat-handler.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ pokemon1, pokemon2 }),
  });

  const logs = await response.json();
  logs.forEach((log) => {
    const logEntry = document.createElement("p");
    logEntry.textContent = log;
    logsContainer.appendChild(logEntry);
  });
});

document.addEventListener("DOMContentLoaded", loadPokemonOptions);
