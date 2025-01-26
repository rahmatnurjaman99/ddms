import { useState } from 'react';
import { Line } from 'react-chartjs-2';
import 'chart.js/auto';
import data from './statistics.json';

const chartData = {
  views: data.views,
  likes: data.likes,
  subscribers: data.subscribes,
};

const Dashboard = () => {
  const [activeMenu, setActiveMenu] = useState('Dashboard');
  const [isSidebarOpen, setIsSidebarOpen] = useState(false);

  const createChartData = (label : string, data : number[]) => ({
    labels: [
      'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
      'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
    ],
    datasets: [
      {
        label,
        data,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1,
      },
    ],
  });

  return (
    <div className="flex h-screen bg-gray-100">
      {/* Toggle Button for Mobile */}
      <button
        className="sm:hidden fixed top-4 left-4 z-50 bg-blue-900 text-white p-2 rounded"
        onClick={() => setIsSidebarOpen(!isSidebarOpen)}
      >
        {isSidebarOpen ? 'Close Menu' : 'Open Menu'}
      </button>

      {/* Sidebar */}
      <aside
        className={`w-64 bg-blue-900 text-white fixed sm:relative top-0 left-0 h-full z-40 transform transition-transform duration-300 sm:translate-x-0 ${
          isSidebarOpen ? 'translate-x-0' : '-translate-x-full'
        } sm:block`}
      >
        <div className="p-4 font-bold text-xl border-b border-gray-700">Menu</div>
        <ul className="p-4 space-y-4">
          {['Dashboard', 'Report', 'Management User'].map((menu) => (
            <li
              key={menu}
              onClick={() => setActiveMenu(menu)}
              className={`cursor-pointer p-2 rounded ${
                activeMenu === menu ? 'bg-blue-700' : ''
              }`}
            >
              {menu}
            </li>
          ))}
        </ul>
      </aside>

      {/* Main Content */}
      <div className="flex-1 flex flex-col">
        {/* Header */}
        <header className="flex items-center justify-between bg-white shadow p-4">
          <h1 className="text-xl font-bold">{activeMenu}</h1>
          <div className="flex items-center space-x-4">
            <img
              src="https://placehold.co/40"
              alt="Profile"
              className="w-10 h-10 rounded-full"
            />
            <div>
              <p className="font-bold">Rahmat Nurjaman</p>
              <p className="text-sm text-gray-500">Admin</p>
            </div>
          </div>
        </header>

        {/* Content */}
        <main className="p-4 overflow-y-auto">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            {/* View Chart */}
            <div className="bg-white p-4 rounded shadow">
              <h2 className="text-lg font-bold mb-4">Jumlah View per Bulan (2024)</h2>
              <Line data={createChartData('Views', chartData.views)} />
            </div>

            {/* Like Chart */}
            <div className="bg-white p-4 rounded shadow">
              <h2 className="text-lg font-bold mb-4">Jumlah Like per Bulan (2024)</h2>
              <Line data={createChartData('Likes', chartData.likes)} />
            </div>

            {/* Subscriber Chart */}
            <div className="bg-white p-4 rounded shadow">
              <h2 className="text-lg font-bold mb-4">Jumlah Subscriber per Bulan (2024)</h2>
              <Line data={createChartData('Subscribers', chartData.subscribers)} />
            </div>
          </div>
        </main>
      </div>
    </div>
  );
};

export default Dashboard;
