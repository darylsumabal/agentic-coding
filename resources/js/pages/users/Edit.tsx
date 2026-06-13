import { Form, Head, Link, usePage } from '@inertiajs/react';
import { ArrowLeft } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/input-error';
import { index as usersIndex, update } from '@/routes/users';

interface User {
    id: number;
    name: string;
    email: string;
}

export default function UsersEdit() {
    const { user } = usePage<{ user: User }>().props;

    return (
        <>
            <Head title="Edit User" />
            <div className="pb-8">
                <div className="mb-6 flex items-center gap-3">
                    <Link href={usersIndex().url}>
                        <ArrowLeft className="h-5 w-5" />
                    </Link>
                    <h1 className="text-2xl font-bold">Edit User</h1>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>Edit User</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Form
                            {...update.form({ user: user.id })}
                            className="space-y-6"
                        >
                            {({ processing, errors }) => (
                                <>
                                    <div className="grid gap-2">
                                        <Label htmlFor="name">Name</Label>
                                        <Input
                                            id="name"
                                            name="name"
                                            defaultValue={user.name}
                                            placeholder="Enter full name"
                                            required
                                        />
                                        <InputError message={errors.name} />
                                    </div>

                                    <div className="grid gap-2">
                                        <Label htmlFor="email">Email</Label>
                                        <Input
                                            id="email"
                                            type="email"
                                            name="email"
                                            defaultValue={user.email}
                                            placeholder="Enter email address"
                                            required
                                        />
                                        <InputError message={errors.email} />
                                    </div>

                                    <div className="grid gap-2">
                                        <Label htmlFor="password">Password (leave blank to keep current)</Label>
                                        <Input
                                            id="password"
                                            type="password"
                                            name="password"
                                            placeholder="Enter new password"
                                        />
                                        <InputError message={errors.password} />
                                    </div>

                                    <div className="grid gap-2">
                                        <Label htmlFor="password_confirmation">Confirm Password</Label>
                                        <Input
                                            id="password_confirmation"
                                            type="password"
                                            name="password_confirmation"
                                            placeholder="Confirm new password"
                                        />
                                        <InputError message={errors.password_confirmation} />
                                    </div>

                                    <div className="flex items-center gap-4">
                                        <Button disabled={processing}>
                                            {processing ? 'Updating...' : 'Update User'}
                                        </Button>
                                    </div>
                                </>
                            )}
                        </Form>
                    </CardContent>
                </Card>
            </div>
        </>
    );
}
