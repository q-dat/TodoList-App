fetch("/api/products.php")
  .then((response) => response.json())
  .then((products) => {
    const list = document.getElementById("product-list");
    products.forEach((product) => {
      const li = document.createElement("li");
      li.textContent = product.name;
      list.appendChild(li);
    });
  });
