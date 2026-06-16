import { Form, Head, Link, useForm } from '@inertiajs/react';
import { ArrowLeft } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/input-error';
import { index as usersIndex, store } from '@/routes/users';

export default function UsersCreate() {
    const { data, setData, processing, errors, reset, submit } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const handleSubmit = (e: React.SubmitEvent<HTMLFormElement>) => {
        e.preventDefault();

        submit('post', store().url, {
            onSuccess: () => reset(),
            onError: (e) => console.log(e),
        });
    };

    return (
        <>
            <Head title="Create User" />
            <div className="pb-8">
                <div className="mb-6 flex items-center gap-3">
                    <Link href={usersIndex().url}>
                        <ArrowLeft className="h-5 w-5" />
                    </Link>
                    <h1 className="text-2xl font-bold">Create User</h1>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>Create New User</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Form
                            method="POST"
                            action={store().url}
                            onSuccess={() => reset()}
                            onError={(e) => console.log(e)}
                            className="space-y-6"
                        >
                            <div className="grid gap-2">
                                <Label htmlFor="name">Name</Label>
                                <Input
                                    // id="name"
                                    // value={data.name}
                                    // onChange={(e) =>
                                    //     setData('name', e.target.value)
                                    // }
                                    name="name"
                                    placeholder="Enter full name"
                                    required
                                />
                                <InputError message={errors.name} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="email">Email</Label>
                                <Input
                                    // id="email"
                                    // type="email"
                                    // value={data.email}
                                    // onChange={(e) =>
                                    //     setData('email', e.target.value)
                                    // }
                                    name="email"
                                    placeholder="Enter email address"
                                    required
                                />
                                <InputError message={errors.email} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="password">Password</Label>
                                <Input
                                    // id="password"
                                    // type="password"
                                    // value={data.password}
                                    // onChange={(e) =>
                                    //     setData('password', e.target.value)
                                    // }
                                    name="password"
                                    placeholder="Enter password"
                                    required
                                    minLength={8}
                                />
                                <InputError message={errors.password} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="password_confirmation">
                                    Confirm Password
                                </Label>
                                <Input
                                    // id="password_confirmation"
                                    // type="password"
                                    // value={data.password_confirmation}
                                    // onChange={(e) =>
                                    //     setData(
                                    //         'password_confirmation',
                                    //         e.target.value,
                                    //     )
                                    // }
                                    name="password_confirmation"
                                    placeholder="Confirm password"
                                    required
                                />
                                <InputError
                                    message={errors.password_confirmation}
                                />
                            </div>

                            <div className="flex items-center gap-4">
                                <Button disabled={processing}>
                                    {processing ? 'Creating...' : 'Create User'}
                                </Button>
                            </div>
                        </Form>
                    </CardContent>
                </Card>
            </div>
        </>
    );
}
