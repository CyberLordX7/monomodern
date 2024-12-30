import FeatureUpvoteDownvote from '@/Components/FeatureUpvoteDownvote';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Feature} from '@/types';
import { Head } from '@inertiajs/react';

export default function Show({feature}:{feature: Feature}) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Features
                </h2>
            }
        >
            <Head title={'Features '+feature.name} />

            <div className="mb-4 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
            <div className="p-6 text-gray-900 dark:text-gray-100 flex gap-8">
               <FeatureUpvoteDownvote feature={feature}/>

                <div className="flex-1">
                    <h2 className="text-2xl mb-2">{feature.name}</h2>
                    <p>{feature.description }</p>

                </div>
            </div>
        </div>
        </AuthenticatedLayout>
    );
}
