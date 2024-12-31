import FeatureItem from '@/Components/FeatureItem';
import { can } from '@/helpers';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Feature, PageProps, PaginatedData } from '@/types';
import { Head, Link } from '@inertiajs/react';

export default function Index({auth, features}:PageProps<{features: PaginatedData<Feature>}>) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Features
                </h2>
            }
        >
            <Head title="Dashboard" />
            {
                can(auth.user, 'manage_features') && (<Link href={route('features.create')} className="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">
                Create New Feature
               </Link>)
               }

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                   {
                    features.data.map((features)=>(
                        <FeatureItem key={features.id} feature={features}/>
                    ))
                   }
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
