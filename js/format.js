function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
  }

  function formatTime(date) {
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return `${hours}:${minutes}`;
  }
  function parseTime(timeString) {
	const [hours, minutes] = timeString.split(':').map(Number);
	const time = new Date();
	time.setHours(hours, minutes, 0, 0);
	return time;
  }

  function parseDate(dateStr) {
	let year, month, day;
  
	if (dateStr.includes('/')) {
	  // CSVフォーマットの場合
	  [year, month, day] = dateStr.split('/').map(Number);
	} else if (dateStr.includes('-')) {
	  // inputタグフォーマットの場合
	  [year, month, day] = dateStr.split('-').map(Number);
	}
  
	return new Date(year, month - 1, day);
  }
