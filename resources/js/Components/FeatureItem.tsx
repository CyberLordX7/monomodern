import { Feature } from "@/types";
import { Link } from "@inertiajs/react";
import { useState } from "react";
import FeatureActionDropdown from "./FeatureActionDropdown";
import FeatureUpvoteDownvote from "./FeatureUpvoteDownvote";

export default function FeatureItem({feature}:{feature:Feature}){
    const [isExpanded, setIsExpanded] = useState(false);

    const toggleReadMore = () =>{
        setIsExpanded(!isExpanded);
    }

    return(
        <div className="mb-4 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
            <div className="p-6 text-gray-900 dark:text-gray-100 flex gap-8">
                <FeatureUpvoteDownvote feature={feature}/>
                <div className="flex-1">
                    <Link href={route('features.show', feature.id)}>
                       <h2 className="text-2xl mb-2">{feature.name}</h2>
                    </Link>
                    {(feature.description || '').length > 200 && (
                    <>
                      <p>{isExpanded? feature.description : `${(feature.description || '').slice(0,200)}...`}</p>
                      <button onClick={toggleReadMore} className="text-amber-500 hover:underline">
                      {isExpanded ? 'Read Less': 'Read More'}
                       </button>
                    </>
                    )}
                     {(feature.description || '').length <=  200 && (
                        <p>{feature.description}</p>
                     )}
                     <div className="mt-4">
                        <Link href={route('features.show', feature.id)} className="hover:text-blue-700 focus:z-10 focus:ring-4 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Comments
                        </Link>
                     </div>
                </div>
                <div className="flex flex-col items-center">
                    <FeatureActionDropdown  feature={feature}/>
                </div>
            </div>
        </div>
    );
}
