'use strict';

import m from 'mithril';
import Chart from './components/chart.js';
import Datepicker from './components/datepicker.js';
import Totals from './components/totals.js';
import TopPosts from './components/top-posts.js';
import './admin.css';

m._request = m.request;
m.request = function(url, opts = {}) {
	opts.headers = {
		"X-WP-Nonce": zp.nonce
	};
	return m._request(url, opts);
};
const now = new Date();

function App() {
	let startDate = new Date(now.getFullYear(), now.getMonth(), 1, 0, 0, 0);
	let endDate = new Date(now.getFullYear(), now.getMonth() + 1, 0, 23, 59, 59);

	function setDates(s, e) {
		if (s !== startDate) {
			startDate = s;
		}

		if (e !== endDate) {
			endDate = e;
		}

		m.redraw();
	}

    return {
        view() {
        	return (
				<main>
					<Datepicker startDate={startDate} endDate={endDate} onUpdate={setDates} />
					<Totals startDate={startDate} endDate={endDate} />
					<Chart startDate={startDate} endDate={endDate} />
					<TopPosts startDate={startDate} endDate={endDate}  />
				</main>
			)
		}
    }
}

m.mount(document.getElementById('zp-mount'), App);