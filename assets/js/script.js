document.addEventListener("DOMContentLoaded", function () {
  const url = "/TodoList-App/api/tasks";
  const list = document.getElementById("task-list");

  fetch(url)
    .then((res) => res.json())
    .then((t) => {
      list.innerHTML = "";
      t.data.forEach((task) => {
        const li = document.createElement("li");
        const strong = document.createElement("strong");
        strong.textContent = task.title;
        list.appendChild(li);
        li.appendChild(strong);
      });
    })
    .catch((error) => {
      list.innerHTML = `<li style="color:red;">Không thể kết nối đến API</li>`;
      console.error("Lỗi khi lấy dữ liệu:", error);
    });
});
