import { Feature } from "@/types";
import TextAreaInput from "./TextAreaInput";
import { useForm } from "@inertiajs/react";
import PrimaryButton from "./PrimaryButton";

export default function NewCommentForm({ feature }: { feature:Feature}) {
    const {data, setData,post, processing} = useForm({
        comment:''
    })
    const createComment = (e:React.FormEvent<HTMLFormElement>) =>{
        e.preventDefault();

        post(route('comment.store', feature.id),{
            preserveScroll:true,
            preserveState:true,
            onSuccess: ()=>setData('comment', '')
        })
    }
    return (
       <form onSubmit={createComment} className=" py-2 rounded-lg bg-gry-50 dark:bg-gray-800">
            <label htmlFor="sr-only">Your Comment</label>
            <div  className="flex items-center gap-4 mt-4 bg-gray-50 dark:bg-gray-800 rounded-lg ">
             <TextAreaInput rows={2}  name="comment"
             value={data.comment}
             id="comment"
             aria-placeholder="Your Comment"
             onChange={e=>setData('comment', e.target.value)}
             className="w-full p-2 border rounded-lg" placeholder="Your Comment" required>
             </TextAreaInput>
             <PrimaryButton disabled={processing}>Comment</PrimaryButton>
            </div>
       </form>
    )
}
