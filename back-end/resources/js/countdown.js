function startCountdown(endDate) {
  const countdownInterval = setInterval(() => {
      const currentTime = new Date().getTime();
      const timeDiff = endDate - currentTime;

      if (timeDiff <= 0) {
          clearInterval(countdownInterval);
      }

      const daysLeft = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
      const hoursLeft = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutesLeft = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));

      remainingTimeEl.innerHTML = `${daysLeft} giorni, ${hoursLeft + 2} ore, ${minutesLeft} minuti`;
  }, 1000);
}

const latestExpiryDate = document.getElementById("latestExpiryDate").innerHTML;
const remainingTimeEl = document.getElementById("remainingTime");
if(latestExpiryDate != "") {
  const expiryFrom1970 = new Date(latestExpiryDate).getTime();
  startCountdown(expiryFrom1970);
}