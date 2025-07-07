function scrollToElement(element, duration = 1500) {
  const start = window.scrollY;
  const end = element.getBoundingClientRect().top + window.scrollY - 150;
  const distance = end - start;
  let startTime = null;

  function animation(currentTime) {
    if (!startTime) startTime = currentTime;
    const elapsed = currentTime - startTime;
    const progress = Math.min(elapsed / duration, 1);
    window.scrollTo(0, start + distance * easeInOutQuad(progress));
    if (elapsed < duration) {
      requestAnimationFrame(animation);
    }
  }

  function easeInOutQuad(t) {
    return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
  }

  requestAnimationFrame(animation);
}

document.addEventListener("DOMContentLoaded", () => {
  const urlParams = new URLSearchParams(window.location.search);
  const p = urlParams.get("p");
  // todos os valores possíveis para as versões PT e EN
  const targets = { calculadora: "calculadora", calculator: "calculadora" };
  if (p && targets[p]) {
    const el = document.getElementById(targets[p]);
    if (el) scrollToElement(el, 1000);
  }
});
