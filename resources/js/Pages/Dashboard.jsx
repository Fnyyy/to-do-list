import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';

export default function Dashboard({ auth, stats, recent_tasks }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {/* Stats Grid */}
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        {/* Active Projects Card */}
                        <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-neon rounded-lg p-6 relative group transform hover:scale-105 transition-transform duration-300">
                            <div className="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-neon-500 rounded-full opacity-20 filter blur-xl group-hover:opacity-40 transition-opacity"></div>
                            <h3 className="text-lg font-medium text-gray-500 dark:text-gray-400">Active Projects</h3>
                            <p className="text-4xl font-bold text-gray-900 dark:text-white mt-2">{stats.active_projects}</p>
                        </div>

                        {/* Pending Tasks Card */}
                        <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-neon rounded-lg p-6 relative group transform hover:scale-105 transition-transform duration-300">
                            <div className="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-500 rounded-full opacity-20 filter blur-xl group-hover:opacity-40 transition-opacity"></div>
                            <h3 className="text-lg font-medium text-gray-500 dark:text-gray-400">Pending Tasks</h3>
                            <p className="text-4xl font-bold text-gray-900 dark:text-white mt-2">{stats.pending_tasks}</p>
                        </div>

                        {/* Completed Tasks Card */}
                        <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-neon rounded-lg p-6 relative group transform hover:scale-105 transition-transform duration-300">
                            <div className="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-green-500 rounded-full opacity-20 filter blur-xl group-hover:opacity-40 transition-opacity"></div>
                            <h3 className="text-lg font-medium text-gray-500 dark:text-gray-400">Completed Tasks</h3>
                            <p className="text-4xl font-bold text-gray-900 dark:text-white mt-2">{stats.completed_tasks}</p>
                        </div>
                    </div>

                    {/* Recent Activity Section */}
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <h3 className="text-lg font-semibold mb-4">Recent Tasks</h3>
                            <div className="space-y-4">
                                {recent_tasks.length === 0 ? (
                                    <p className="text-gray-500">No recent tasks.</p>
                                ) : (
                                    recent_tasks.map((task) => (
                                        <div key={task.id} className="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:shadow-md transition-shadow">
                                            <div>
                                                <h4 className="font-semibold">{task.title}</h4>
                                                <p className="text-sm text-gray-500 dark:text-gray-400">
                                                    Project: <span className="font-medium text-neon-500">{task.project.name}</span>
                                                </p>
                                            </div>
                                            <div className="flex items-center space-x-2">
                                                <span className={`px-2 py-1 text-xs rounded-full ${task.priority === 'urgent' ? 'bg-red-100 text-red-800' :
                                                        task.priority === 'high' ? 'bg-orange-100 text-orange-800' :
                                                            'bg-green-100 text-green-800'
                                                    }`}>
                                                    {task.priority}
                                                </span>
                                                <Link href={route('projects.show', task.project.id)} className="text-sm text-blue-500 hover:underline">
                                                    View
                                                </Link>
                                            </div>
                                        </div>
                                    ))
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
