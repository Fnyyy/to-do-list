import { Menu, MenuButton, MenuItem, MenuItems, Transition } from '@headlessui/react';
import { Fragment } from 'react';
import { BellIcon } from '@heroicons/react/24/outline';
import { Link } from '@inertiajs/react';

export default function NotificationDropdown({ notifications }) {
    return (
        <Menu as="div" className="relative ml-3">
            <div>
                <MenuButton className="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span className="sr-only">View notifications</span>
                    <BellIcon className="h-6 w-6" aria-hidden="true" />
                    {notifications.length > 0 && (
                        <span className="absolute top-0 right-0 block h-2.5 w-2.5 rounded-full bg-neon-500 ring-2 ring-gray-900" />
                    )}
                </MenuButton>
            </div>
            <Transition
                as={Fragment}
                enter="transition ease-out duration-100"
                enterFrom="transform opacity-0 scale-95"
                enterTo="transform opacity-100 scale-100"
                leave="transition ease-in duration-75"
                leaveFrom="transform opacity-100 scale-100"
                leaveTo="transform opacity-0 scale-95"
            >
                <MenuItems className="absolute right-0 z-10 mt-2 w-80 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-gray-800">
                    <div className="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                        <h3 className="text-sm font-semibold text-gray-900 dark:text-white">Notifications</h3>
                    </div>
                    {notifications.length === 0 ? (
                        <div className="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
                            No new notifications
                        </div>
                    ) : (
                        notifications.map((notification) => (
                            <MenuItem key={notification.id}>
                                {({ focus }) => (
                                    <Link
                                        href={notification.data.url}
                                        className={`${focus ? 'bg-gray-100 dark:bg-gray-700' : ''
                                            } block px-4 py-2 text-sm text-gray-700 dark:text-gray-300`}
                                    >
                                        {notification.data.message}
                                        <div className="text-xs text-gray-500 mt-1">
                                            {new Date(notification.created_at).toLocaleString()}
                                        </div>
                                    </Link>
                                )}
                            </MenuItem>
                        ))
                    )}
                </MenuItems>
            </Transition>
        </Menu>
    );
}
