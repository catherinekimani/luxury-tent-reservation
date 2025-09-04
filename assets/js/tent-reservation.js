document.addEventListener("DOMContentLoaded", function () {
  const checkinInput = document.getElementById("checkin");
  const checkoutInput = document.getElementById("checkout");
  const tentsInput = document.getElementById("tents");
  const totalElement = document.getElementById("calculated-total");
  const pricePerNightInput = document.getElementById("price_per_night");

  if (
    !checkinInput ||
    !checkoutInput ||
    !tentsInput ||
    !totalElement ||
    !pricePerNightInput
  ) {
    return;
  }

  const pricePerNight = parseInt(pricePerNightInput.value) || 22000;

  function calculateTotal() {
    const checkin = new Date(checkinInput.value);
    const checkout = new Date(checkoutInput.value);
    const numTents = parseInt(tentsInput.value) || 1;

    if (checkin && checkout && checkout > checkin) {
      const nights = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));
      const total = nights * numTents * pricePerNight;
      totalElement.textContent = total.toLocaleString() + ".00";
    } else {
      totalElement.textContent = pricePerNight.toLocaleString() + ".00";
    }
  }

  [checkinInput, checkoutInput, tentsInput].forEach((el) => {
    el.addEventListener("change", calculateTotal);
  });

  const today = new Date().toISOString().split("T")[0];
  checkinInput.setAttribute("min", today);

  checkinInput.addEventListener("change", function () {
    if (this.value) {
      const checkinDate = new Date(this.value);
      checkinDate.setDate(checkinDate.getDate() + 1);
      checkoutInput.setAttribute(
        "min",
        checkinDate.toISOString().split("T")[0]
      );

      if (
        checkoutInput.value &&
        new Date(checkoutInput.value) <= new Date(this.value)
      ) {
        checkoutInput.value = "";
      }
    }
  });
});
