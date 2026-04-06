const timeline = document.querySelector('.timeline-component');
const bar = document.querySelector('.timeline_progress-bar');

window.addEventListener('scroll', () => {
  const rect = timeline.getBoundingClientRect();
  const circleY = window.innerHeight * 0.5;

  let height = circleY - rect.top;
  height = Math.min(Math.max(height, 0), timeline.offsetHeight);

  bar.style.height = height + 'px';
});
