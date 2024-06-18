function updateBrightness(id, value) {
	var xhr = new XMLHttpRequest()
	xhr.open("POST", "control.php", true)
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			console.log("Brightness updated successfully")
		}
	}
	xhr.send("id=" + id + "&action=brightness&value=" + value)
}

function toggleLight(id) {
	var xhr = new XMLHttpRequest()
	xhr.open("POST", "control.php", true)
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			console.log("Light toggled successfully")
		}
	}
	xhr.send("id=" + id + "&action=toggle")
}

function updateScheduleDays(id, value) {
	var xhr = new XMLHttpRequest()
	xhr.open("POST", "control.php", true)
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			console.log("Schedule days updated successfully")
		}
	}
	xhr.send("id=" + id + "&action=schedule_days&value=" + value)
}

function updateStartTime(id, value) {
	var xhr = new XMLHttpRequest()
	xhr.open("POST", "control.php", true)
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			console.log("Start time updated successfully")
		}
	}
	xhr.send("id=" + id + "&action=start_time&value=" + value)
}

function updateEndTime(id, value) {
	var xhr = new XMLHttpRequest()
	xhr.open("POST", "control.php", true)
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			console.log("End time updated successfully")
		}
	}
	xhr.send("id=" + id + "&action=end_time&value=" + value)
}

function controlLight(id, state) {
	var xhr = new XMLHttpRequest()
	xhr.open("POST", "control.php", true)
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4 && xhr.status == 200) {
			console.log("LED control action performed successfully")
		}
	}
	xhr.send("id=" + id + "&action=toggle&value=" + state)
}
