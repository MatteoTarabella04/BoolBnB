function startCountdown(endDate) {
  const countdownInterval = setInterval(() => {
      const currentTime = new Date().getTime();
      const timeDiff = endDate - currentTime;

      if (timeDiff <= 0) {
          clearInterval(countdownInterval);
          location.reload();
      }

      const daysLeft = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
      const hoursLeft = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutesLeft = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));

      remainingTimeEl.innerHTML = `${daysLeft} giorni, ${hoursLeft} ore, ${minutesLeft} minuti`;
  }, 1000);
}

const latestExpiryDate = document.getElementById("latestExpiryDate").value;
const remainingTimeEl = document.getElementById("remainingTime");
if(latestExpiryDate != "") {
  const expiryFrom1970 = new Date(latestExpiryDate).getTime() + 7200000; //ADD 7200000ms TO COMPENSATE UTC TIME ON DATABASE
  startCountdown(expiryFrom1970);
}
